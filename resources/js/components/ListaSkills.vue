<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4" :class="verificar(ski)"
                v-for="(ski, i) in skills"
                :key="i"
                @click="Activar($event)"
                >{{ski}}</li><!--! No dejar espacion en "li" porque se guardaran -->
        </ul>
        <input type="hidden" name="habilidad" id="skills">
    </div>
</template>

<script>
export default {
    props:{
        skills:{
            require:true,
            type:Array
        },
        oldskills:{
            require:true,
            type:String
        }
    },

    data(){
        return{
            habilidades:new Set() //El set es como un arreglo solo que no permite datos repetidos
        }

    },
    created:function(){
        if(this.oldskills){
            const skillsArray =  this.oldskills.split(',')
            skillsArray.forEach(skill => this.habilidades.add(skill));
        }
    },

    mounted(){
        document.querySelector('#skills').value = this.oldskills
    },
    methods:{
        verificar(skill){
            //?Comprobar cuales son las skill que existen
            return this.habilidades.has(skill) ? 'bg-teal-400' : ''
        },

        Activar(e){
            if(e.target.classList.contains('bg-teal-400')){
                //esta activo
                e.target.classList.remove('bg-teal-400');

                //Eliminar del set
                this.habilidades.delete(e.target.textContent)
            } else{

                e.target.classList.add('bg-teal-400');
                //agregar al set de habilidades
                this.habilidades.add(e.target.textContent)
            }

            //agregaar las habilidades al input hidden
            const HabilidadesSeleccionadas = [...this.habilidades]
            document.querySelector('#skills').value = HabilidadesSeleccionadas
        }
    }
}
</script>

<style>

</style>
