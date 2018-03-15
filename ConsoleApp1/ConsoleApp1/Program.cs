using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;

namespace ConsoleApp1
{
    class Program
    {
        public static int left_A { get { return 1; } }
        public static int left_B { get { return 28; } }
        public static int row_net { get; set; }
        public static Random rng = new Random();

        public static CMDListsArray CMDReceived;

        static void Main(string[] args)
        {
            //for (int i = 0; i < 10; ++i)
            //{
            //    System.Threading.Thread.Sleep(500);
            //    Console.Write("\r{0}%   ", i);
            //}


            //string line = "";

            //for (int i = 0; i < 100; i++)
            //{
            //    System.Threading.Thread.Sleep(500);
            //    string backup = new string('\b', line.Length);
            //    Console.Write(backup);
            //    line = string.Format("{0}%", i);
            //    Console.Write(line);
            //}

            //Console.SetCursorPosition((Console.WindowWidth - 10), 0);
            //Console.Write("{0:HH:mm:ss}", DateTime.Now);

            

            var w = new Work();
            ThreadStart k = w.received;
            var thread2 = new Thread(k);
            thread2.Start();
        }
        
    }

    public class Work
    {
        public static Random rng = new Random();

        public static CMDListsArray CMDReceived;

        public void network_signal()
        {
            while (true)
            {
                Thread.Sleep(1000);
                // network
                Console.SetCursorPosition(Program.left_B, 5);
                Console.Write(string.Format("SMART -> {0}%", Program.rng.Next(99)));
            }
        }

        int row_count = 1;
        
        public void received()
        {
            CMDReceived = new CMDListsArray();

            while (true)
            {
                Thread.Sleep(1000);

                int rows = Program.row_net + 1;

                CMDListName n = new CMDListName();
                n.DateTime = DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt");
                n.Mobile = rng.Next(99).ToString();
                n.Message = rng.Next(99).ToString();
                CMDReceived.Add(n);
                
                row_count = 1;

                var counter = CMDReceived.Count - 1;

                for (int x = counter; x > 0; x--)
                {
                    CMDListName xssn = new CMDListName();
                    xssn.DateTime = CMDReceived[x].DateTime;
                    xssn.Mobile = CMDReceived[x].Mobile;
                    xssn.Message = CMDReceived[x].Message;

                    Thread.Sleep(100);
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", xssn.DateTime));

                    Console.SetCursorPosition(28, rows);
                    Console.Write(string.Format("{0} > {1}", xssn.Mobile, xssn.Mobile));

                    if (rows >= 10)
                    {
                        break;
                    }
                    rows++;
                }
            }
        }




        //Console.SetWindowSize(100, 17);

        //    int row = 0;

        //Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Cyan;
        //    Console.Write("SMSReceiver");
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write(" by ");
        //    Console.ForegroundColor = ConsoleColor.Cyan;
        //    Console.Write("fb@kingpauloaquino");
        //    row++;

        //    row++;
        //    // status
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Green;
        //    Console.Write("Modem Status");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("Online");


        //    row++;
        //    // license
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("License");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("PRO-Standard");

        //    row++;
        //    // version
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Version");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("2.1.0");

        //    row++;
        //    // network
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Network");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write(string.Format("SMART -> {0}%", rng.Next(99)));

        //    row++;
        //    // network
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Memory");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write(string.Format("{0}", rng.Next(99)));

        //    row++;
        //    // number
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Number");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("09171236547");

        //    row++;
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Uid");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("09171236547");

        //    row++;
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Assigned");
        //    Console.SetCursorPosition(left_B, row);
        //    Console.Write("LoadStop");


        //    row++;
        //    row++;
        //    Console.SetCursorPosition(left_A, row);
        //    Console.ForegroundColor = ConsoleColor.Gray;
        //    Console.Write("Text Received");

        //    row_net = row;
            

        //    Console.CursorVisible = true;
        //    var w = new Work();

        //ThreadStart s = w.network_signal;
        //var thread1 = new Thread(s);
        //thread1.Start();
    }
}
