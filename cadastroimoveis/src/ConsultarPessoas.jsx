import React, { useEffect, useState } from "react";
import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  Typography,
  Button,
  CircularProgress,
} from "@mui/material";

const ConsultarPessoas = () => {
  const [pessoas, setPessoas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    // Fetch dados do backend
    fetch("http://localhost/cadastro_imoveis/api/pessoas.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erro ao buscar os dados.");
        }
        return response.json();
      })
      .then((data) => {
        setPessoas(data);
        setLoading(false);
      })
      .catch((err) => {
        setError(err.message);
        setLoading(false);
      });
  }, []);

  return (
    <div style={{ padding: "20px", background: "#f5f5f5", minHeight: "100vh" }}>
      <Typography variant="h4" align="center" gutterBottom>
        Consultar Pessoas Cadastradas
      </Typography>

      <Button
        variant="contained"
        color="primary"
        href="/"
        style={{ marginBottom: "20px" }}
      >
        &larr; Voltar para o Índice
      </Button>

      {loading ? (
        <div style={{ display: "flex", justifyContent: "center", marginTop: "20px" }}>
          <CircularProgress />
        </div>
      ) : error ? (
        <Typography color="error" align="center">
          {error}
        </Typography>
      ) : pessoas.length > 0 ? (
        <TableContainer component={Paper} style={{ marginTop: "20px" }}>
          <Table>
            <TableHead style={{ backgroundColor: "#1976d2" }}>
              <TableRow>
                <TableCell style={{ color: "#fff" }}>ID</TableCell>
                <TableCell style={{ color: "#fff" }}>Nome</TableCell>
                <TableCell style={{ color: "#fff" }}>Data de Nascimento</TableCell>
                <TableCell style={{ color: "#fff" }}>CPF</TableCell>
                <TableCell style={{ color: "#fff" }}>Sexo</TableCell>
                <TableCell style={{ color: "#fff" }}>Telefone</TableCell>
                <TableCell style={{ color: "#fff" }}>E-mail</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {pessoas.map((pessoa) => (
                <TableRow key={pessoa.id}>
                  <TableCell>{pessoa.id}</TableCell>
                  <TableCell>{pessoa.nome}</TableCell>
                  <TableCell>
                    {new Date(pessoa.data_nascimento).toLocaleDateString("pt-BR")}
                  </TableCell>
                  <TableCell>{pessoa.cpf}</TableCell>
                  <TableCell>{pessoa.sexo}</TableCell>
                  <TableCell>{pessoa.telefone}</TableCell>
                  <TableCell>{pessoa.email}</TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>
      ) : (
        <Typography align="center" color="textSecondary">
          Nenhuma pessoa cadastrada.
        </Typography>
      )}
    </div>
  );
};

export default ConsultarPessoas;