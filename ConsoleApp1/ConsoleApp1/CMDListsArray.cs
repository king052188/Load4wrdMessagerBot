using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApp1
{
    public class CMDListsArray : List<CMDListName> { }

    public class CMDListName
    {
        public string DateTime { get; set; }
        public string Mobile { get; set; }
        public string Message { get; set; }
    }
}
