<template>
  <div id="app">
    <div>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Crie sua conta na Memorar</title>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous"
      />
      <link rel="preconnect" href="https://fonts.gstatic.com" />
      <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;700&display=swap"
        rel="stylesheet"
      />
    </div>

    <div class="container my-4 col-lg-6 col-xl-4">
      <div class="d-flex justify-content-center">
        <img
          src="./assets/logo-memorar.png"
          alt="logo Loja Memorar"
          width="200px"
        />
      </div>
      <h1 class="text-center h5 fw-bold mb-3 mt-1">
        Crie sua conta na Memorar
      </h1>
      <form v-on:submit.prevent="onSubmitFunction" class="row gx-3">
        <div class="form-floating mb-3">
          <input
            v-model="userForm.name"
            placeholder="Nome Completo"
            class="form-control"
            type="name"
            id="completeUserName"
            required
          />
          <label for="completeUserName">Nome Completo</label>
        </div>
        <div class="col-sm-6 form-floating mb-3">
          <input
            v-model="userForm.phone"
            class="form-control"
            type="tel"
            placeholder="Telefone"
            id="phoneNumber"
            pattern="^\s*(\d{2}|\d{0})[-. ]?(\d{5}|\d{4})[-. ]?(\d{4})[-. ]?\s*$"
            required
          />
          <label for="phoneNumber">Telefone</label>
        </div>
        <div class="col-sm-6 form-floating mb-3">
          <input
            v-model="userForm.birthDate"
            class="form-control"
            type="date"
            id="birthday"
            placeholder="Data de Nascimento"
            required
          />
          <label for="birthday">Data de Nascimento</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="userForm.email"
            class="form-control"
            id="email"
            type="email"
            placeholder="E-mail"
            pattern="^\w+([-+.']\w+)*@\w+)*@\w+([-.]]\w+)*\.\w+([-.]\w+)*$"
            required
          />
          <label for="email">E-mail</label>
        </div>
        <div class="col-sm-6 form-floating">
          <input
            v-model="userForm.pass"
            class="form-control"
            id="password"
            type="password"
            placeholder="Crime uma Senha"
            pattern="^(?=.*A-Za-z])(?=.*\d)"
            required
          />
          <label for="password">Crie uma Senha</label>
        </div>
        <small class="ps-4 text-muted d-sm-none"
          >Sua senha deverá ter ao menos 8 caracteres, 1 número e 1 letra</small
        >
        <div class="col-sm-6 form-floating">
          <input
            v-model="userForm.passRepeat"
            class="form-control"
            id="repeatedPassword"
            type="password"
            placeholder="Repita a senha"
            required
          />
          <label for="repeatedPassword">Repita a senha</label>
        </div>
        <small class="ps-4 text-muted d-none d-sm-block"
          >Sua senha deverá ter ao menos 8 caracteres, 1 número e 1 letra</small
        >
        <div class="form-floating mb-3 mt-3">
          <input
            v-model="userForm.cpf"
            class="form-control"
            id="CPF"
            type="text"
            placeholder="Seu CPF"
            pattern="^([-\.\s]]?(\d{3})){3}[-\.\s]?(\d{2})$"
            required
          />
          <label id="CPF">Seu CPF</label>
        </div>

        <div class="alert alert-danger" v-if="showErrorMessage">
          {{ errorMessage }}
        </div>

        <input
          class="p-3 px-5 w-auto btn btn-primary m-auto"
          type="submit"
          value="Criar conta"
        />
      </form>

      <table id="cadastro" class="table table-striped mt-5">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Nascimento</th>
            <th scope="col">E-mail</th>
            <th scope="col">CPF</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.phone }}</td>
            <td>{{ user.birthDate }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.cpf }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "App",
  components: {},
  data: function () {
    return {
      showErrorMessage: false,
      errorMessage: "aconteceu algo de errado",
      userForm: {},
      users: [],
    };
  },

  methods: {
    onSubmitFunction: function () {
      console.log("Submeteu!");
      if (this.userForm.pass != this.userForm.passRepeat) {
        this.showErrorMessage = true;
        this.errorMessage = "As senhas não são iguais, por favor verifique";
      } else {
        this.showErrorMessage = false;

        const data = new URLSearchParams();

        for (var [key, value] of Object.entries(this.userForm)) {
          data.append(key, value);
        }
        axios.post("http://localhost:9090/users", data).then(() => {
          this.getUsers();
        });
      }
    },
    getUsers: function () {
      axios.get("http://localhost:9090/users").then((response) => {
        this.users = response.data;
      });
    },
  },
  mounted: function () {
    this.getUsers();
  },
};
</script>

<style>
* {
  font-family: "Work Sans", sans-serif;
}

#createAccount label {
  left: auto !important;
}
</style>
