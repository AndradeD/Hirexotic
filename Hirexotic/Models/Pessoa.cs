using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.Models
{
    public class Pessoa
    {
        public virtual long Id { get; set; }
        public virtual string Nome { get; set; }
        public virtual string Endereco { get; set; }
        public virtual string Telefone { get; set; }
        public virtual int Tipo { get; set; }                
    }
}