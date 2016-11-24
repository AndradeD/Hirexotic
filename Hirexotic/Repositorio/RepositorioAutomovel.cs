using Hirexotic.Models;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Validation;
using System.Data.SqlClient;
using System.Linq;
using System.Linq.Expressions;
using System.Web;

namespace Hirexotic.Repositorio
{
    public class AutomovelRepositorio
    {

        private SqlConnection con;
        //To Handle connection related activities

        private void connection()
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            con = new SqlConnection(constr);

        }

        public void InsertAutomovel(Automovel automovel)
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            //Create the SQL Query for inserting an article
            string sqlQuery = String.Format("Insert into automovel(id, placa, ano_fabricacao, cor, combustivel, preco_minimo, modelo_id, fornecedor_id) values({0},'{1}','{2}','{3}','{4}','{5}','{6}','{7}')"
            ,"select max(id)+1 from automovel"+ automovel.Placa, automovel.AnoFabricacao, automovel.Cor, automovel.Combustivel,automovel.PrecoMinimo,automovel.Modelo.Id,automovel.Fornecedor.Id);

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            //Create a Command object
            SqlCommand command = new SqlCommand(sqlQuery, connection);

            //Execute the command to SQL Server and return the newly created ID
            int newAutomovelID = Convert.ToInt32((decimal)command.ExecuteScalar());

            //Close and dispose
            command.Dispose();
            connection.Close();
            connection.Dispose();
        }

        public List<Automovel> GetAutomoveis()
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            List<Automovel> result = new List<Automovel>();

            //Create the SQL Query for returning all the articles
            string sqlQuery = String.Format("select * from automovel");

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            SqlCommand command = new SqlCommand(sqlQuery, connection);

            //Create DataReader for storing the returning table into server memory
            SqlDataReader dataReader = command.ExecuteReader();

            Automovel automovel = null;

            //load into the result object the returned row from the database
            if (dataReader.HasRows)
            {
                while (dataReader.Read())
                {
                    automovel = new Automovel();
                    automovel.Id = Convert.ToInt32(dataReader["Id"]);
                    automovel.Placa = Convert.ToString(dataReader["Placa"]);
                    automovel.Combustivel = Convert.ToString(dataReader["Combustivel"]);
                    automovel.AnoFabricacao = Convert.ToInt32(dataReader["AnoFabricacao"]);
                    automovel.Cor = Convert.ToString(dataReader["Cor"]);
                    automovel.Fornecedor.Id = Convert.ToInt32(dataReader["Fornecedor.Id"]);
                    automovel.PrecoMinimo = Convert.ToDouble(dataReader["PrecoMinimo"]);
                    automovel.Modelo.Id = Convert.ToInt32(dataReader["Modelo.Id"]);                    

                    result.Add(automovel);
                }
            }

            return result;

        }


        public void SaveAutomovel(Automovel automovel)
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();

            //Create the SQL Query for updating an article
            string createQuery = String.Format("Insert into automovel(id, placa, ano_fabricacao, cor, combustivel, preco_minimo, modelo_id, fornecedor_id) values('{1}','{2}','{3}','{4}','{5}','{6}','{7}')"
           + "Select @@Identity", automovel.Placa, automovel.AnoFabricacao, automovel.Cor, automovel.Combustivel, automovel.PrecoMinimo, automovel.Modelo.Id, automovel.Fornecedor.Id);

            string updateQuery = String.Format("Update automovel SET placa='{0}', ano_fabricacao = '{1}', cor ='{2}', combustivel = {3},preco_minimo = {4},modelo_id = {5},fornecedor_id = {6} Where Id = {7};",
             automovel.Placa, automovel.AnoFabricacao, automovel.Cor, automovel.Combustivel, automovel.PrecoMinimo, automovel.Modelo.Id, automovel.Fornecedor.Id, automovel.Id);

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            //Create a Command object
            SqlCommand command = null;

            if (automovel.Id != 0)
                command = new SqlCommand(updateQuery, connection);
            else
                command = new SqlCommand(createQuery, connection);

            long savedArticleID = 0;
            try
            {
                //Execute the command to SQL Server and return the newly created ID
                var commandResult = command.ExecuteScalar();
                if (commandResult != null)
                {
                    savedArticleID = Convert.ToInt32(commandResult);
                }
                else
                {
                    //the update SQL query will not return the primary key but if doesn't throw exception 
                    //then we will take it from the already provided data
                    savedArticleID = automovel.Id;
                }
            }
            catch (Exception ex)
            {
                //there was a problem executing the script
            }

            //Close and dispose
            command.Dispose();
            connection.Close();
            connection.Dispose();            
        }

        public void DeleteAutomovel(int AutomovelId)
        {            
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            //Create the SQL Query for deleting an article
            string sqlQuery = String.Format("delete from automovel where Id = {0}", AutomovelId);

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            //Create a Command object
            SqlCommand command = new SqlCommand(sqlQuery, connection);

            // Execute the command
            int rowsDeletedCount = command.ExecuteNonQuery();
           
            command.Dispose();
            connection.Close();
            connection.Dispose();
        }
    }
}