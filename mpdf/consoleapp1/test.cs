using System;
namespace consoleapp1
{
    class test
    {
        int i,j;
        private int c = 123;

         public int C   // property
          {
           get { return c; }
           }
           
        public void insert(int a,int b)
        {
            i=a;
            j=b;
        }
        public void calc()
        {
               Console.WriteLine(i*j);
        }
    }
}