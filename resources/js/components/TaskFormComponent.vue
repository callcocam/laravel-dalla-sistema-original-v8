<template>
    <div>
        <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" @click="form = {
                    id:'',
                    name:'',
                    description:'',
                }">Adicionar Tarefa</button>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <form id="addUser" @submit.prevent="submitTask()">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informações da tarefa</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" class="form-control mb-3" id="name" type="text" name="name" aria-describedby="name" placeholder="Nome da tarefa" required />
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.description" class="form-control" id="description" name="description" placeholder="Observações...." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="close" class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary" type="submit">Salvar Tarefa</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props:['event', 'task','route'],
        data() {
            return {
                form:{
                    id:'',
                    event:'',
                    name:'',
                    description:'',
                }
            }
        },
        methods:{

            submitTask(){

                this.form.event = this.event.id

                axios.post(`/${this.route}/tarefas/update`,this.form).then(response=>{

                    this.$emit('input', response.data)
                    this.$refs['close'].click()
                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: 'success',
                        text: 'Tarefa atualizado com sucesso!!'
                    });


                }).catch(err=>{
                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: 'warn',
                        text: 'Não foi possivel atualizar a tarefa!!'
                    });
                })
            }
        },
        watch:{
            task(val){

                if(val){
                    this.form = Object.assign({}, val)
                }
            }
        }
    }
</script>
