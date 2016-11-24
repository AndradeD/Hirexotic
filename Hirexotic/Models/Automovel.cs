using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Hirexotic.Models
{      
    public class Automovel
    {
        public long Id { get; set; }
        public string Placa { get; set; }
        public int AnoFabricacao { get; set; }
        public string Cor { get; set; }
        public string Combustivel { get; set; }
        public double PrecoMinimo { get; set; }
        public Modelo Modelo { get; set; }
        public Fornecedor Fornecedor { get; set; }
    }
}