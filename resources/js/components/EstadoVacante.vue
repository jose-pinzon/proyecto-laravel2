<template>
        <div>
            <span
            @click="cambiarEstado"
            :key="estadoVacanteData"
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
            :class="ClaseEstadoVacante()">
                {{EstadoText}}
            </span>
        </div>

</template>

<script>
export default {
props:{
    estado:{
        required:true,
        type:String
    },
    vacante_id:{
        required:true,
        type:String
    }
},

mounted(){
    this.estadoVacanteData = Number(this.estado)
},
data(){
    return{
        estadoVacanteData:null
    }
},
methods:{
    ClaseEstadoVacante(){
        return this.estadoVacanteData === 1 ? "bg-green-100  text-green-800" : "bg-red-100  text-red-800"
    },

    async cambiarEstado(){
        this.estadoVacanteData == 1 ? this.estadoVacanteData = 0 : this.estadoVacanteData = 1

            // !Los params se leen con el request
        const params = {
            estado:this.estadoVacanteData
        }
        //?Enviar datos
        const { data } = await axios.post('/vacantes/' + this.vacante_id, params)
        console.log(data);
    }
},

computed:{
    EstadoText(){
            return this.estadoVacanteData === 1 ? 'Activa' : 'Inactiva'
        }
    }
}






</script>

<style>

</style>
