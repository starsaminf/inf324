namespace PersonaApp.Model
{
    public class PersonaModel
    {
        public string CI { get; set; } = String.Empty;
        public string NombreCompleto { get; set; } = String.Empty;
        public DateTime FechaNacimiento { get; set; } = DateTime.Now;
        public string Telefono { get; set; } = String.Empty;
        public string Departamento { get; set; } = String.Empty;
    }
}
