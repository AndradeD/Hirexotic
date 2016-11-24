using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.Models
{
    public class Funcionario
    {
        public virtual long Id { get; set; }
        public virtual string Cargo { get; set; }
        public virtual long CPF { get; set; }
        public virtual string Sexo { get; set; }
        public virtual DateTime DataNascimento { get; set; }
        public virtual int Matricula { get; set; }
        public virtual Pessoa Pessoa { get; set; }
    }
}