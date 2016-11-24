using Hirexotic.Models;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace Hirexotic.Repositorio
{
    public class RepositorioModelo
    {
        private SqlConnection con;
        //To Handle connection related activities

        private void connection()
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            con = new SqlConnection(constr);

        }

        public void InsertModelo(Modelo modelo)
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            //Create the SQL Query for inserting an article
            string sqlQuery = String.Format("Insert into modelo(id, nome, marca, ano, numero_passageiros, velocidade, cilindrada, numero_portas, fornecedor_id) values('{1}','{2}','{3}','{4}','{5}','{6}','{7}')"
            + "Select @@Identity", modelo.Nome, modelo.Marca, modelo.Ano, modelo.NumeroPassageiros, modelo.Velocidade, modelo.Cilindrada, modelo.NumeroPortas, modelo.Fornecedor.Id);

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

        public List<Modelo> GetModelos()
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            List<Modelo> result = new List<Modelo>();

            //Create the SQL Query for returning all the articles
            string sqlQuery = String.Format("select * from modelo");

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            SqlCommand command = new SqlCommand(sqlQuery, connection);

            //Create DataReader for storing the returning table into server memory
            SqlDataReader dataReader = command.ExecuteReader();

            Modelo modelo = null;

            //load into the result object the returned row from the database
            if (dataReader.HasRows)
            {
                while (dataReader.Read())
                {
                    modelo = new Modelo();
                    modelo.Id = Convert.ToInt32(dataReader["Id"]);
                    modelo.Ano = Convert.ToInt32(dataReader["Ano"]);
                    modelo.Cilindrada = Convert.ToInt32(dataReader["Cilindrada"]);
                    modelo.Marca = Convert.ToString(dataReader["Marca"]);
                    modelo.Nome = Convert.ToString(dataReader["Nome"]);
                    modelo.Velocidade = Convert.ToInt32(dataReader["Velocidade"]);
                    modelo.NumeroPassageiros = Convert.ToInt32(dataReader["NumeroPassageiros"]);
                    modelo.NumeroPortas = Convert.ToInt32(dataReader["NumeroPortas"]);
                    modelo.Fornecedor.Id = Convert.ToInt32(dataReader["Fornecedor.Id"]);                    

                    result.Add(modelo);
                }
            }

            return result;

        }


        public void SaveModelo(Modelo modelo)
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();

            //Create the SQL Query for updating an article
            string createQuery = String.Format("Insert into modelo(id, nome, marca, ano, numero_passageiros, velocidade, cilindrada, numero_portas, fornecedor_id) values('{1}','{2}','{3}','{4}','{5}','{6}','{7}')"
           + "Select @@Identity", modelo.Nome, modelo.Marca, modelo.Ano, modelo.NumeroPassageiros, modelo.Velocidade, modelo.Cilindrada, modelo.NumeroPortas,modelo.Fornecedor.Id);

            string updateQuery = String.Format("Update Articles SET nome='{0}', marca = '{1}', ano ='{2}', numero_passageiros = {3},velocidade = {4},cilindrada = {5},numero_portas = {6} Where fornecedor_id = {7};",
             modelo.Nome, modelo.Marca, modelo.Ano, modelo.NumeroPassageiros, modelo.Velocidade, modelo.Cilindrada, modelo.NumeroPortas, modelo.Fornecedor.Id);

            //Create and open a connection to SQL Server 
            SqlConnection connection = new SqlConnection(constr);
            connection.Open();

            //Create a Command object
            SqlCommand command = null;

            if (modelo.Id != 0)
                command = new SqlCommand(updateQuery, connection);
            else
                command = new SqlCommand(createQuery, connection);

            long savedModeloID = 0;
            try
            {
                //Execute the command to SQL Server and return the newly created ID
                var commandResult = command.ExecuteScalar();
                if (commandResult != null)
                {
                    savedModeloID = Convert.ToInt32(commandResult);
                }
                else
                {
                    //the update SQL query will not return the primary key but if doesn't throw exception 
                    //then we will take it from the already provided data
                    savedModeloID = modelo.Id;
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

        public void DeleteModelo(int modeloId)
        {
            string constr = ConfigurationManager.ConnectionStrings["DefaultConnection"].ToString();
            //Create the SQL Query for deleting an article
            string sqlQuery = String.Format("delete from modelo where id = {0}", modeloId);

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