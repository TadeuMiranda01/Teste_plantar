<template>
    <div class="about">
      <h1>This is an cidades page</h1>
      <hr>
        <div v-for="cidade in cidades">
            {{cidade.grupo_id}}<br>
            {{cidade.nome}}<br>
            {{cidade.idade}}<br>
            {{cidade.estado}}<br>
        </div>
    </div>
  </template>

<script>



    export default {
        data() {
            return {
                cidades: []
            }
        },

        created(){
            fetch('http://localhost:8000/api/cidade')
            .then(response => response.json())
            .then(r => {
                this.cidades = r;
            })

        }
    }

</script>
  