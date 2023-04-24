using Microsoft.AspNetCore.Mvc;
using Microsoft.Data.SqlClient;
using PersonaApp.Model;
using System.Net;

namespace PersonaApp.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class PersonaController : ControllerBase
    {

        SqlConnection con;
        string connectionString = @"uid=sloza;pwd=sloza;
                            database=mi_base_samuel_loza;
                            server=DESKTOP-KMU86PG\SQLEXPRESS;TrustServerCertificate=True";
        public PersonaController()
        {
            con = new SqlConnection(connectionString);
        }

        [HttpGet]
        public async Task<IEnumerable<PersonaModel>> Get()
        {
            string query = "SELECT ci, nombre_completo, fecha_nacimiento, telefono, departamento FROM persona";
            con.Open();

            using (SqlCommand command = new SqlCommand(query, con))
            {
                using (SqlDataReader reader = command.ExecuteReader())
                {
                    List<PersonaModel> personas = new List<PersonaModel>();

                    while (reader.Read())
                    {
                        PersonaModel persona = new PersonaModel();
                        persona.CI = reader.GetString(0);
                        persona.NombreCompleto = reader.GetString(1);
                        persona.FechaNacimiento = reader.GetDateTime(2);
                        persona.Telefono = reader.GetString(3);
                        persona.Departamento = reader.GetString(4);
                        personas.Add(persona);
                    }
                    con.Close();
                    return personas;
                }
            }
        }

        [HttpGet("{id}")]
        public async Task<IEnumerable<PersonaModel>> GetByCi(string ci)
        {
            string query = "SELECT ci, nombre_completo, fecha_nacimiento, telefono, departamento FROM persona WHERE ci = " + ci;
            con.Open();

            using (SqlCommand command = new SqlCommand(query, con))
            {
                using (SqlDataReader reader = command.ExecuteReader())
                {
                    List<PersonaModel> personas = new List<PersonaModel>();

                    while (reader.Read())
                    {
                        PersonaModel persona = new PersonaModel();
                        persona.CI = reader.GetString(0);
                        persona.NombreCompleto = reader.GetString(1);
                        persona.FechaNacimiento = reader.GetDateTime(2);
                        persona.Telefono = reader.GetString(3);
                        persona.Departamento = reader.GetString(4);
                        personas.Add(persona);
                    }
                    con.Close();
                    return personas;
                }
            }
        }

        [HttpPost]
        public async Task<ActionResult<PersonaModel>> Create(PersonaModel persona)
        {
            string query = "INSERT INTO persona (ci, nombre_completo, fecha_nacimiento, telefono, departamento) " +
                    "VALUES (@ci, @nombre, @fecha, @telefono, @departamento)";

            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand(query, con))
                {
                    cmd.Parameters.AddWithValue("@ci", persona.CI);
                    cmd.Parameters.AddWithValue("@nombre", persona.NombreCompleto);
                    cmd.Parameters.AddWithValue("@fecha", persona.FechaNacimiento);
                    cmd.Parameters.AddWithValue("@telefono", persona.Telefono);
                    cmd.Parameters.AddWithValue("@departamento", persona.Departamento);

                    int result = await cmd.ExecuteNonQueryAsync();
                    if (result > 0)
                    {
                        return Ok(persona);
                    }
                    else
                    {
                        return BadRequest();
                    }
                }
            }
        }

        [HttpPut]
        public async Task<ActionResult<PersonaModel>> Update(PersonaModel persona)
        {
            string query = "UPDATE persona SET nombre_completo = @nombre, fecha_nacimiento = @fecha, telefono = @telefono, departamento = @departamento " +
                           "WHERE ci = @ci";

            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand(query, con))
                {
                    cmd.Parameters.AddWithValue("@nombre", persona.NombreCompleto);
                    cmd.Parameters.AddWithValue("@fecha", persona.FechaNacimiento);
                    cmd.Parameters.AddWithValue("@telefono", persona.Telefono);
                    cmd.Parameters.AddWithValue("@departamento", persona.Departamento);
                    cmd.Parameters.AddWithValue("@ci", persona.CI);

                    int result = await cmd.ExecuteNonQueryAsync();
                    if (result > 0)
                    {
                        return Ok(persona);
                    }
                    else
                    {
                        return BadRequest();
                    }
                }
            }
        }

        [HttpDelete("{ci}")]
        public async Task<IActionResult> Delete(string ci)
        {
            string query = "DELETE FROM persona WHERE ci = @ci";

            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand(query, con))
                {
                    cmd.Parameters.AddWithValue("@ci", ci);

                    int result = await cmd.ExecuteNonQueryAsync();
                    if (result > 0)
                    {
                        return Ok();
                    }
                    else
                    {
                        return BadRequest();
                    }
                }
            }
        }
    }
}

