using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.Models
{
    public class Modelo
    {
        public virtual long Id { get; set; }
        public virtual string Nome { get; set; }
        public virtual string Marca { get; set; }
        public virtual int Ano { get; set; }
        public virtual int NumeroPassageiros { get; set; }
        public virtual int Velocidade { get; set; }
        public virtual int Cilindrada { get; set; }
        public virtual int NumeroPortas { get; set; }
        public virtual Fornecedor Fornecedor { get; set; }                     

    }
}