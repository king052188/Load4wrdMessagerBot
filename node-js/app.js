var express                   = require('express');
var bodyParser                = require('body-parser');
var request                   = require('request');
var cache                     = require('memory-cache');
var settings                  = require('./settings.js');
var app                       = express();

app.use(bodyParser.urlencoded({"extended": false}));
app.use(bodyParser.json());

const PAGE_ACCESS_TOKEN       = settings.PAGE_ACCESS_TOKEN; // facebook page-access-token
const VERIFY_TOKEN            = settings.VERIFY_TOKEN; // facebook verification-token
const ACCESS_TOKEN            = settings.ACCESS_TOKEN; // load4wrd aaccess-token
const API_URL                 = settings.API_URL; // load4wrd api url
const API_SMS                 = settings.API_SMS; // ptxt4wrd api url

var newCache;
var sender_fbuid;
var count                     = 0;
var timer_sleep               = 1500;

// Test
app.get('/test', (req, res) => {
  res.setHeader('Content-Type', 'application/json');
  console.log(settings);
  res.json(settings);
});

// Test
app.get('/mpin', (req, res) => {
  var cache_mpin = newCache.get('MPIN');
  var users_mpin = req.query["pin"]
  console.log("mem_cache: " + cache_mpin);
  console.log("user_pin: " + users_mpin);
  res.setHeader("Content-Type", "text/html");
  if(parseInt(cache_mpin) == parseInt(users_mpin)) {
    res.send("nice");
  }
  res.send("nope");
});

app.get('/messenger/send', (req, res) => {
  var fb_id = req.query["fb_id"];
  var message = req.query["message"];
  MessengerSend(fb_id, message, res);
});

// To verify
app.get('/webhook', (req, res) => {
  if(req.query['hub.verify_token'] === VERIFY_TOKEN) {
    res.send(req.query['hub.challenge']);
  }
  res.send('Error, wrong validation token');
});

app.post('/webhook', (req, res) => {

  // Parse the request body from the POST
  let body = req.body;

  // Check the webhook event is from a Page subscription
  if (body.object === 'page') {

    // Iterate over each entry - there may be multiple if batched
    body.entry.forEach(function(entry) {

      // Gets the body of the webhook event
      let webhook_event = entry.messaging[0];
      console.log(webhook_event);

      // Get the sender PSID
      let sender_psid = webhook_event.sender.id;
      console.log('Sender PSID: ' + sender_psid);

      // Check if the event is a message or postback and
      // pass the event to the appropriate handler function
      if (webhook_event.message) {
        handleMessage(sender_psid, webhook_event.message);
      } else if (webhook_event.postback) {
        handlePostback(sender_psid, webhook_event.postback);
      }

    });

    // Return a '200 OK' response to all events
    res.status(200).send('EVENT_RECEIVED');

  } else {
    // Return a '404 Not Found' if event is not from a page subscription
    res.sendStatus(404);
  }

});

////

function MessengerSend(sender_psid, message, res_json) {
  // Construct the message body
  let response;
  // Create the payload for a basic text message
  response = {
    "text": `${message}`
  }

  let request_body = {
    "recipient": {
      "id": sender_psid
    },
    "message": response
  }

  // Send the HTTP request to the Messenger Platform
  request({
    "uri": "https://graph.facebook.com/v2.6/me/messages",
    "qs": { "access_token": PAGE_ACCESS_TOKEN },
    "method": "POST",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      console.log('message sent!');
      res_json.json({ status: 200, message: "message sent" });
    } else {
      console.error("Unable to send message:" + err);
      res_json.json({ status: 500, message: "sending failed" });
    }
  });
}

// pollystore commands

function handleMessage(sender_psid, received_message) {
  let response;
  // Check if the message contains text
  if (received_message.text) {
    // Create the payload for a basic text message
    var data;
    var msg = received_message.text;

    if(msg.includes("REG") || msg.includes("Reg") || msg.includes("reg")) {
      data = msg.split(" ");
      console.log(data);
      if(data.length > 0) {
        verify(sender_psid, data[1], "reg");
      }
    }
    else if(msg.includes("TAG") || msg.includes("Tag") || msg.includes("tag")) {
      data = msg.split(" ");
      console.log(data);
      if(data.length > 0) {
        verify(sender_psid, data[1], "tag");
      }
    }
    else if(msg.includes("CODE")) {
      data = msg.split(" ");
      console.log(data);
      if(data.length > 0) {
        register(sender_psid, data[1]);
      }
    }
    else if(msg.includes("LOAD")) {
      command_load(sender_psid, msg);
    }
    else if(msg.includes("OTP")) {
      data = msg.split(" ");
      console.log(data);
      if(data.length > 0) {
        otp_validation(sender_psid, data[1]);
      }
    }
    else if(msg.includes("PTXT")) {
      console.log(msg);
      PTXT4wrdSend(sender_psid, msg);
    }
    else {
      command(sender_psid, msg);
    }
  }
}

// messenger api

function handleMessageSend(sender_psid, received_message) {
  let response;
  // Create the payload for a basic text message
  response = {
    "text": `${received_message}`
  }
  // Sends the response message
  return callSendAPI(sender_psid, response);
}

function handlePostback(sender_psid, received_postback) {
  let response;

  // Get the payload for the postback
  let payload = received_postback.payload;

  // Set the response based on the postback payload
  if (payload === 'yes') {
    response = { "text": "Thanks!" }
  } else if (payload === 'no') {
    response = { "text": "Oops, try sending another image." }
  }
  // Send the message to acknowledge the postback
  callSendAPI(sender_psid, response);
}

function callSendAPI(sender_psid, response) {
  // Construct the message body
  let request_body = {
    "recipient": {
      "id": sender_psid
    },
    "message": response
  }

  // Send the HTTP request to the Messenger Platform
  request({
    "uri": "https://graph.facebook.com/v2.6/me/messages",
    "qs": { "access_token": PAGE_ACCESS_TOKEN },
    "method": "POST",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      console.log('message sent!');
      return true;
    } else {
      console.error("Unable to send message:" + err);
      return false;
    }
  });
}

// pollystore 1020

function verify(sender_psid, mobile, type) {
  if(mobile.length != 11) {
    console.log("Invalid mobile number.");
    handleMessageSend(sender_psid, "Invalid mobile number 1.");
    return false;
  }

  let request_body = {
    "fb_id": sender_psid,
    "mobile": mobile
  }

  newCache = new cache.Cache();
  request({
    "uri": API_URL + "/api/v1/verify/" + type + "/" + ACCESS_TOKEN,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      var status = parseInt(body['status']);
      var message = body['message'];
      if(status != 200) {
        console.log(message);
        handleMessageSend(sender_psid, message);
        return false;
      }

      var code = body['one_time_password'];
      var type = body['type'];
      newCache.put('CODE', code);
      newCache.put('TYPE', type);
      newCache.put('MOBILE', mobile);
      newCache.put('FACEBOOK_ID', sender_psid);
      console.log(newCache.get('CODE'));
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

function register(sender_psid, code) {
  if(code.length != 6) {
    console.log("Invalid length OTP.");
    handleMessageSend(sender_psid, "Invalid length OTP.");
    return false;
  }

  var cache_code = newCache.get('CODE');
  if(cache_code != code) {
    console.log("Invalid OTP.");
    handleMessageSend(sender_psid, "Invalid OTP.");
    return false;
  }

  var type = newCache.get('TYPE');
  var fb_id = newCache.get('FACEBOOK_ID');
  var mobile = newCache.get('MOBILE');
  let request_body = {
    "fb_id": fb_id,
    "mobile": mobile
  }

  request({
    "uri": API_URL + "/api/v1/register/" + type + "/" + ACCESS_TOKEN,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      var status = parseInt(body['status']);
      var message = body['message'];
      console.log(message);
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

function command(sender_psid, command) {

  let request_body = {
    "account": sender_psid,
    "command": command
  }

  console.log(request_body);

  request({
    "uri": API_URL + "/api/v1/load/command/web/" + ACCESS_TOKEN,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      var status = parseInt(body['status']);
      var message = body['message'];
      console.log(message);
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

function command_load(sender_psid, command) {
  sender_fbuid = sender_psid;
  let request_body = {
    "account": sender_psid,
    "command": command
  }
  newCache = new cache.Cache();
  var url = API_URL + "/api/v1/load/command/web/" + ACCESS_TOKEN;
  request({
    "uri": url,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      var status = parseInt(body['status']);
      var message = body['message'];
      var command = body['command'];

      console.log("status: " + status);
      console.log("message: " + message);
      console.log("command: " + command);

      if(status == 404) {
        handleMessageSend(sender_psid, message);
        return false;
      }

      var cmd = "PROCEED " + command["code"] + " " + command["mobile"];
      var otp = command["one_time_password"];

      console.log("cmd: " + cmd);
      console.log("otp: " + otp);

      newCache.put('cmd', cmd);
      newCache.put('otp', otp);

      console.log("cmdC: " + newCache.get('cmd'));
      console.log("otpC: " + newCache.get('otp'));
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

function otp_validation(sender_psid, users_mpin) {
  var cache_mpin;
  var cache_command;
  try{

    cache_mpin = newCache.get('otp');
    cache_command = newCache.get('cmd');

    if(parseInt(cache_mpin) == parseInt(users_mpin)) {
      console.log("cache_mpin: " + cache_mpin);
      console.log("cache_command: " + cache_command);

      command(sender_psid, cache_command);

      newCache.put('cmd', "4234dfdsfdsr3243");
      newCache.put('otp', "4234dfdsfdsr3243");
    }
    else {
      handleMessageSend(sender_psid, "Your One-Time-Password is not valid. Please check your mobile.");
    }

  } catch( err ){
    handleMessageSend(sender_psid, "You don't have any load request yet.");
  }
  console.log("cache_mpin: " + cache_mpin);
  console.log("users_mpin: " + users_mpin);
}

function command_proceed(sender_psid) {

  sender_fbuid = sender_psid;
  console.log("cmdC: " + newCache.get('cmd'));

  let request_body = {
    "account": sender_psid,
    "command": newCache.get('cmd')
  }
  console.log(request_body);

  request({
    "uri": API_URL + "/api/v1/load/proceed/" + ACCESS_TOKEN,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      console.log(body);
      var status = parseInt(body['status']);
      var message = body['message'];
      console.log("status: " + status);
      console.log("message: " + message);
      if(status != 200) {
        handleMessageSend(sender_psid, message);
        return false;
      }
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

// ptxt4wrd command

function PTXT4wrdSend(sender_psid, command) {

  let request_body = {
    "command": command
  }

  console.log(request_body);

  request({
    "uri": API_URL + "/api/v1/ptxt/send/" + sender_psid,
    "method": "GET",
    "json": request_body
  }, (err, res, body) => {
    if (!err) {
      var status = parseInt(body['status']);
      var message = body['message'];
      console.log(message);
      handleMessageSend(sender_psid, message);
    }
    else {
      console.error("Unable to send message:" + err);
      stringMSG = "Unable to send message:" + err;
      handleMessageSend(sender_psid, stringMSG);
    }
  });
}

app.listen(3200);

// app.listen(process.env.PORT);
