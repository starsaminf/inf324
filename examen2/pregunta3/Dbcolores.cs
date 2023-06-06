using System;

namespace WindowsFormsApplication1
{
    public class Dbcolores
    {
        public String descripcion;
        public int r;
        public int g;
        public int b;
        public String color;

        public Dbcolores(string descripcion, int cR, int cG, int cB, string color)
        {
            this.descripcion = descripcion;
            this.r = cR;
            this.g = cG;
            this.b = cB;
            this.color = color;
        }
    }
}
