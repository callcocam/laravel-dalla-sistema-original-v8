<template>
    <div>
        <notifications group="foo"  position="bottom center" width="100%" />
        <form id="addUser" @submit.prevent="submitForm()">
            <input name="event_id" type="hidden" v-model="event.event_id">

            <div class="form-group row">
                <label for="customer_service" class="col-form-label col-md-3 col-sm-3 label-align">Como foi o atendimento da equipe Dalla Cervejaria?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Como foi o atendimento da equipe Dalla Cervejaria?"
                           name="customer_service"
                           type="text"
                           id="customer_service"
                           class="form-control"
                           v-model="event.customer_service"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="draft_beer_quality" class="col-form-label col-md-3 col-sm-3 label-align">Em relação a qualidade do chopp, como estava?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Em relação a qualidade do chopp, como estava?"
                           name="draft_beer_quality"
                           type="text"
                           id="draft_beer_quality"
                           class="form-control"
                           v-model="event.draft_beer_quality"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="event_structure" class="col-form-label col-md-3 col-sm-3 label-align">Satisfação referente a estrutura do evento?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Satisfação referente a estrutura do evento?"
                           name="event_structure"
                           type="text"
                           id="event_structure"
                           class="form-control"
                           v-model="event.event_structure"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="amount_beer_consumed" class="col-form-label col-md-3 col-sm-3 label-align">Quantidade de chopp consumido?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Quantidade de chopp consumido?"
                           name="amount_beer_consumed"
                           type="text"
                           id="amount_beer_consumed"
                           class="form-control"
                           v-model="event.amount_beer_consumed"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="make_new_event" class="col-form-label col-md-3 col-sm-3 label-align">Voltaria a fazer um novo evento com a cervejaria?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Voltaria a fazer um novo evento com a cervejaria?"
                           name="make_new_event"
                           type="text"
                           id="make_new_event"
                           class="form-control"
                           v-model="event.make_new_event"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="team_uniform" class="col-form-label col-md-3 col-sm-3 label-align">Com relação ao uniforme da equipe, como estava?</label>
                <div class="col-md-9 col-sm-9 ">
                    <input placeholder="Com relação ao uniforme da equipe, como estava?"
                           name="team_uniform"
                           type="text"
                           id="team_uniform"
                           class="form-control"
                           v-model="event.team_uniform"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="pos_description" class="col-form-label col-md-3 col-sm-3 label-align">Observações gerais:</label>
                <div class="col-md-9 col-sm-9 ">
                    <textarea
                        placeholder="Observações gerais:"
                        name="pos_description"
                        cols="50"
                        rows="10"
                        id="pos_description"
                        class="form-control"
                        v-model="event.pos_description"></textarea>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 offset-md-3"><button type="submit" class="btn btn-primary btn-block">Salvar Pesquisa</button></div>
        </form>
    </div>
</template>

<script>
    export default {
        props:['event','route'],
        methods:{
            submitForm(){
                axios.post(this.route,this.event).then(response=>{

                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: response.data.type,
                        text: response.data.message
                    });


                }).catch(err=>{
                    console.log(err)
                    this.$notify({
                        group: 'foo',
                        title: 'Informação do sistema!!',
                        type: 'warn',
                        text: 'Não foi possivel atualizar a pesquisa!!'
                    });
                })
            }
        }
    }
</script>
