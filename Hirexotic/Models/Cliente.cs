using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.Models
{
    public class Cliente
    {
        public virtual long Id { get; set; }
        public virtual long CPF { get; set; }        
        public virtual string Sexo { get; set; }
        public virtual DateTime DataNascimento { get; set; }
        public virtual Pessoa Pessoa { get; set; }
    }
}