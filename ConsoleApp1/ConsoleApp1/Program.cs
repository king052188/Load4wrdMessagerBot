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
            CMDListsArray a = new CMDListsArray();

            CMDListName n = new CMDListName();
            n.Receive = DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt");
            n.Message = "TestA";
            a.Add(n);

            n = new CMDListName();
            n.Receive = DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt");
            n.Message = "TestB";
            a.Add(n);

            n = new CMDListName();
            n.Receive = DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt");
            n.Message = "TestB";
            a.Add(n);

            var lastItem = a.Count - 1;

            foreach (CMDListName nn in a)
            {
                string x = nn.Receive;
            }



            Console.SetWindowSize(85, 17);



            int row = 0;

            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Cyan;
            Console.Write("SMSReceiver");
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write(" by ");
            Console.ForegroundColor = ConsoleColor.Cyan;
            Console.Write("fb@kingpauloaquino");


            row++;


            row++;
            // status
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Green;
            Console.Write("Modem Status");
            Console.SetCursorPosition(left_B, row);
            Console.Write("Online");


            row++;
            // license
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("License");
            Console.SetCursorPosition(left_B, row);
            Console.Write("PRO-Standard");

            row++;
            // version
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Version");
            Console.SetCursorPosition(left_B, row);
            Console.Write("2.1.0");

            row++;
            // network
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Network");
            Console.SetCursorPosition(left_B, row);
            Console.Write(string.Format("SMART -> {0}%", rng.Next(99)));

            row++;
            // number
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Number");
            Console.SetCursorPosition(left_B, row);
            Console.Write("09171236547");

            row++;
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Uid");
            Console.SetCursorPosition(left_B, row);
            Console.Write("09171236547");

            row++;
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Assigned");
            Console.SetCursorPosition(left_B, row);
            Console.Write("LoadStop");


            row++;
            row++;
            Console.SetCursorPosition(left_A, row);
            Console.ForegroundColor = ConsoleColor.Gray;
            Console.Write("Text Received");

            //row++;
            row_net = row;
            //Console.SetCursorPosition(left_A, row);
            //Console.ForegroundColor = ConsoleColor.Gray;
            //Console.Write(string.Format("{0}", DateTime.Now.ToString("MM-dd-yy hh:mm:ss tt")));
            //Console.SetCursorPosition(left_B, row);
            //Console.Write("09171236547 -> LOAD 30 09171236547");


            //Console.ReadKey();

            Console.CursorVisible = true;
            var w = new Work();

            ThreadStart s = w.network_signal;
            var thread1 = new Thread(s);
            thread1.Start();

            ThreadStart k = w.received;
            var thread2 = new Thread(k);
            thread2.Start();
        }
        
    }

    public class Work
    {
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
            int rows = Program.row_net + 1;
            while (true)
            {
                if(row_count == 1)
                {
                    Thread.Sleep(1000);
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + row_count);


                }

                if(row_count == 2)
                {
                    Thread.Sleep(1000);
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + row_count);


                    rows++;
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + (row_count - 1));
                }

                if (row_count > 2)
                {
                    Thread.Sleep(1000);
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + row_count);

                    rows++;
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + (row_count - 1));

                    rows++;
                    Console.SetCursorPosition(1, rows);
                    Console.ForegroundColor = ConsoleColor.Gray;
                    Console.Write(string.Format("{0}", DateTime.Now.ToString("MM/dd/yyyy hh:mm:ss tt")));
                    Console.SetCursorPosition(28, rows);
                    Console.Write("09171236547 -> LOAD 30 0917123654" + (row_count - 2));

                }

                row_count++;
                rows = Program.row_net + 1;
            }
        }
        
    }
}
