<template>
    <button @click="Eliminar" class="text-red-600 hover:text-red-900  mr-5">Eliminar</button>
</template>

<script>
export default {
    name:'EliminarVacante',
    props:{
        vacante_id:{
            required:true,
            type:String
        }
    },
    methods:{
        Eliminar(){
                this.$swal.fire({
                title: '¿Deseas Eliminar esta vacante?',
                text: "Se eliminaran los datos permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.isConfirmed) {

                    const params = {
                        id:this.vacante_id,
                        _method:'delete'
                    }

                    axios.post(`/vacantes/${this.vacante_id}`,params )
                        .then(Response => {
                                this.$swal.fire(
                                    'Eliminado!',
                                    Response.data.mensaje,
                                    'success'
                                    );

                                //Eliminar del dom

                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                        })
                        .catch(r => console.log(r))


                }
                })
        }

    }
}
</script>

<style>

</style>
