<template>
    <button :id="event" :class="classOption" @click="deleteConfirm()"><i class="fa fa-trash"></i> {{ text }}
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props:{
            event:{
                type:String,
                default:'form'
            },
            textQuestion:{
                type:String,
                default:''
            },
            textConfirm:{
                type:String,
                default:'Confirmar a operação!'
            }
        },
        data() {
            return {
                classOption:'btn btn-danger btn-rounded',
                text:'',
                status:false
            }
        },
        mounted(){
            this.text = this.textQuestion
        },
        methods:{
            deleteConfirm(){
                if(this.status){
                    this.text = this.textQuestion
                    this.classOption = 'btn btn-danger btn-rounded'
                    document.getElementById(this.event).querySelector('form').submit()
                }
                else{
                    this.text = this.textConfirm
                    this.status = true
                    this.classOption = 'btn btn-warning btn-rounded'
                    setTimeout(()=>{
                        this.text = this.textQuestion
                        this.classOption = 'btn btn-danger btn-rounded'
                    }, 5000)
                }
            }

        }
    }
</script>
