using System;
using System.Collections.Generic;
using System.Data.SqlClient;


namespace WindowsFormsApplication1
{
    public class DatabaseUtility
    {
        SqlConnection con;
        SqlCommand cmd;
        public DatabaseUtility()
        {
            con = new SqlConnection();
            cmd = new SqlCommand();

            con.ConnectionString = "Server=DESKTOP-KMU86PG\\SQLEXPRESS;Database=imagenes2;Trusted_Connection=True;MultipleActiveResultSets = true; TrustServerCertificate=True";
            cmd.Connection = con;
        }

        public void Insert(Dbcolores dbcolores) {
            cmd.CommandText = "INSERT INTO colores VALUES('" + dbcolores.descripcion + "'," + dbcolores.r.ToString() + "," + dbcolores.g.ToString() + "," + dbcolores.b.ToString() + ",'" + dbcolores.color + "')";
            con.Open();
            cmd.ExecuteNonQuery();
            con.Close();
        }

        public List<Dbcolores> GetAll()
        {
            SqlDataReader dr;
            List<Dbcolores> list = new List<Dbcolores>();
            cmd.CommandText = "SELECT * FROM colores";
            con.Open();
            dr = cmd.ExecuteReader();
            while (dr.Read())
            {
                String descripcion = dr.GetString(0);
                int cR = dr.GetInt32(1);
                int cG = dr.GetInt32(2);
                int cB = dr.GetInt32(3);
                String color = dr.GetString(4);
                list.Add(new Dbcolores ( descripcion, cR, cG, cB, color ));
            }
            con.Close();
            return list;
        }
    }
}
