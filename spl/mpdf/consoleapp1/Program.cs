using System;

namespace consoleapp1
{
    class Program
    {

        static void MyMethod(String s) 
                {
                Console.WriteLine(s+ " just got executed!");
                }

        static int add(int a,int b)
        {
            return a+b;
        }
        static void Main(string[] args)
        {
            //Console.WriteLine("Hello World!");
           // Console.Write("shamma ");
           //  Console.Write("is my name");
          /*
             
            int age = Convert.ToInt32(Console.ReadLine());      
            string s=Console.ReadLine();
            double Salary = Convert.ToDouble(Console.ReadLine());
            char chr = Console.ReadLine()[0]; 
          
      
           
            Console.WriteLine(age);
            Console.WriteLine(s);
            Console.WriteLine(Salary);
            Console.Write(chr);

            */

           // int a=123;
           // double b=23.45;
           // bool c=true;

           // Console.WriteLine(Convert.ToInt32(b));
            //Console.WriteLine(Convert.ToString(c));
           // Console.WriteLine(Convert.ToDouble(a));

         /*  string[] cars = {"Volvo", "BMW", "Ford", "Mazda"};
           foreach (var i in cars)

           {
               Console.WriteLine(i);    
           }
           */
           /*
           string txt = "Hello World";
            Console.WriteLine(txt.ToUpper());   // Outputs "HELLO WORLD"
            Console.WriteLine(txt.ToLower());
             Console.WriteLine(txt.Length);

              MyMethod("Lamisa") ;
              MyMethod("Quaiyum") ;
              MyMethod("Shamma") ;

              */

              //int result=add(12,23);
            //  Console.WriteLine(result);

              test t =new test();
              //t.insert(10,30);
            //  t.calc();

            //  t.insert(10,60);
            //  t.calc();

                Console.WriteLine(t.C);    //encapsulation
            
        }
    }
}
