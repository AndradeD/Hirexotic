using FluentNHibernate.Cfg;
using FluentNHibernate.Cfg.Db;
using Hirexotic.Models;
using NHibernate;
using NHibernate.Tool.hbm2ddl;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.NHibernateConfig
{
    public static class FluentNHibernateHelper
    {
        public static ISession OpenSession()
        {
            string connectionString = "User ID=postgres;Password=;Host=localhost;Port=5432;Database=pcs-sgbd;Pooling=true;Min Pool Size=0;Max Pool Size=100;Connection Lifetime=0;";
            ISessionFactory sessionFactory = Fluently.Configure().Database(PostgreSQLConfiguration.PostgreSQL82.ConnectionString(connectionString).ShowSql()).Mappings(m =>m.FluentMappings.AddFromAssemblyOf<Automovel>()).ExposeConfiguration(cfg => new SchemaExport(cfg).Create(false, false)).BuildSessionFactory();
            return sessionFactory.OpenSession();
        }

    }
}