<template>
    <section class="ul-todo-list-content">
        <notifications group="foo"  position="bottom center" width="100%" />
        <div class="ul-todo-content-right">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ul-todo-mobile-menu mr-3 p-2"><i class="nav-icon i-Align-Justify-All text-25 ul-contact-mobile-icon"></i></div>
<!--                                <input v-model="configs.filter" class="form-control mr-4" id="todo-list-search" type="text" placeholder="Termo de busca" />-->
                                <task-form-component :route="route"  :event="event" :task="task" v-on:input="loadTasks($event)"/>
                                <!--<div class="btn-group ml-3 mr-3">
                                    <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ordener</button>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-96px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" href="#" @click="configs.order = 'asc'">ASC</a>
                                        <a class="dropdown-item" href="#" @click="configs.order = 'desc'">DESC </a></div>
                                </div>-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ul-widget__head v-margin">
                                <div class="ul-widget__head-label mb-4">
                                    <h3 class="ul-widget__head-title">Lista de tarefas - {{ event.name }}</h3>
                                </div>
                            </div>
                            <div class="ul-widget-body">
                                <div class="ul-widget3">
                                    <div class="ul-widget6__item--table">
                                        <table class="table">
                                            <thead>
                                            <tr class="ul-widget6__tr--sticky-th">
                                                <th scope="col">Nome</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">#</th>
                                            </tr>
                                            </thead>
                                            <tbody v-if="rows">
                                            <!-- start tr-->
                                            <tr v-for="(task, index) in list" :key="index">
                                                <td> {{ task.name }}</td>
                                                <td><span :class="classStatus(task.status)" >{{ setStatus(task.status) }}</span>
                                                    <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="_dot _inline-dot bg-primary"></span><span class="_dot _inline-dot bg-primary"></span>
                                                        <span class="_dot _inline-dot bg-primary"></span>
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item ul-widget__link--font" href="#" @click="updateStatus(task,'published')"><i class="i-Up"></i> Por fazer</a>
                                                        <a class="dropdown-item ul-widget__link--font" href="#" @click="updateStatus(task,'completed')"><i class="i-Down"></i> Feita</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-rounded btn-sm"  data-toggle="modal" data-target=".bd-example-modal-lg" @click="editTask(task)"><i class="fas fa-pencil-alt"></i> </button>
                                                    <button class="btn btn-danger btn-rounded btn-sm" @click="trashTask(task)"><i class="fas fa-trash-alt"></i> </button>
                                                </td>
                                            </tr>
                                            <!-- end tr-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { orderBy, isEmpty } from 'lodash';
    import filterByName from '../helpers/by-name';
    export default {
        props:['tasks','event','route'],
        data(){
            return {
                rows:[],
                task:null,
                configs: {
                    by: 'name',
                    order: 'desc',
                    filter: ''
                }
            }
        },
        mounted(){
            this.rows = this.tasks
        },

        computed: {
            listOrdened() {
                const {  by, order } = this.configs;

                return orderBy(this.rows, by, order);
            },
            list() {
                const filter = this.configs.filter;
                if (isEmpty(filter)) {
                    return this.listOrdened;
                }

                return filterByName(this.listOrdened, filter);
            },
        },
        methods:{
            loadTasks(event){
                this.rows = event
            },
            editTask(task){
                this.task = task
            },
            trashTask(task){

                task.event = this.event.id

                axios.post(`/${this.route}/tarefas/delete`,task).then(response=>{

                    this.rows = response.data
                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: 'success',
                        text: 'Tarefa excluida com sucesso!!'
                    });

                }).catch(err=>{
                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: 'success',
                        text: 'Não foi possivel excluir a tarefa!!'
                    });
                })
            },
            updateStatus(task, status){

                if(status != task.status){

                    task.event = this.event.id

                    task.status = status

                    axios.post(`/${this.route}/tarefas/update`,task).then(response=>{

                       this.rows = response.data
                        this.$notify({
                            group: 'foo',
                            title: 'Informação do sistema!!',
                            type: 'success',
                            text: 'Situação da tarefa atualizado com sucesso!!'
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
            setStatus(status){
                if(status == 'published'){
                    return 'A fazer';
                }

                return 'Feito';

            },
            classStatus(status){

                if(status == 'published'){
                    return 'badge badge-pill badge-outline-danger p-2 m-1';
                }

                return 'badge badge-pill badge-outline-success p-2 m-1';
            }
        }
    }
</script>
