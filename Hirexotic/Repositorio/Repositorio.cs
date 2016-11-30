using Hirexotic.NHibernateConfig;
using NHibernate;
using NHibernate.Linq;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Hirexotic.Repositorio
{
    public class Repositorio<T> where T : class
    {
        private static readonly ISessionFactory sessionFactory;
        private ITransaction transaction;

        public ISession Session { get; private set; }

        public Repositorio()
        {
            Session = FluentNHibernateHelper.OpenSession();
        }

        public void BeginTransaction()
        {
            transaction = Session.BeginTransaction();
        }

        public void Commit()
        {
            try
            {
                // commit transaction if there is one active
                if (transaction != null && transaction.IsActive)
                    transaction.Commit();
            }
            catch
            {
                // rollback if there was an exception
                if (transaction != null && transaction.IsActive)
                    transaction.Rollback();

                throw;
            }
            finally
            {
                Session.Dispose();
            }
        }

        public void Rollback()
        {
            try
            {
                if (transaction != null && transaction.IsActive)
                    transaction.Rollback();
            }
            finally
            {
                Session.Dispose();
            }
        }

        public IQueryable<T> GetAll()
        {
            return Session.Query<T>();
        }

        public T GetById(int id)
        {
            return Session.Get<T>(id);
        }

        public void Create(T entity)
        {
            Session.Save(entity);
        }

        public void Update(T entity)
        {
            Session.Update(entity);
        }

        public void Delete(int id)
        {
            Session.Delete(Session.Load<T>(id));
        }

    }
}