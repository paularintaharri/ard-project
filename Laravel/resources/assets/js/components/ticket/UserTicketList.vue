<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div>
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            My Tickets
                        </span>

                        <a class="action-link" @click="showCreateTicketForm">
                            Create New Ticket
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <!-- No Tickets Notice -->
                    <p class="m-b-none" v-if="tickets.length === 0">
                        You have not created any personal access tokens.
                    </p>

                    <!-- User's tickets -->
                    <table class="table table-borderless m-b-none" v-if="tickets.length > 0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="ticket in tickets">
                                <!-- Client Name -->
                                <td style="vertical-align: middle;">
                                    {{ ticket.id }}
                                </td>

                                <!-- Delete Button -->
                                <td style="vertical-align: middle;">
                                    <a class="action-link text-danger" @click="revoke(ticket)">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Ticket Modal -->
        <div class="modal fade" id="modal-create-ticket" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Create Ticket
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="form.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in form.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Ticket Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="store">
                            <!-- Amount -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Amount</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-amount" type="text" class="form-control" name="amount" v-model="form.amount">
                                </div>
                            </div>

                            <!-- Scopes -->
                            <!--<div class="form-group" v-if="scopes.length > 0">
                                <label class="col-md-4 control-label">Scopes</label>

                                <div class="col-md-6">
                                    <div v-for="scope in scopes">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                    @click="toggleScope(scope.id)"
                                                    :checked="scopeIsAssigned(scope.id)">

                                                    {{ scope.id }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="store">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Access Token Modal -->
        <div class="modal fade" id="modal-ticket" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Ticket
                        </h4>
                    </div>

                    <div class="modal-body">
                        <p>
                            Here is your new personal access token. This is the only time it will be shown so don't lose it!
                            You may now use this token to make API requests.
                        </p>

                        <pre><code></code></pre>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                currentTicket: null,

                tickets: [],

                form: {
                    id: '',
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getTickets();
                console.log('no tickets');

                $('#modal-create-ticket').on('shown.bs.modal', () => {
                    $('#create-ticket-amount').focus();
                });
            },

            /**
             * Get all of the tickets created by the user.
             */
            getTickets() {
                axios.get('/tickets')
                        .then(response => {
                            this.tickets = response.data;
                        });
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateTicketForm() {
                $('#modal-create-ticket').modal('show');
            },

            /**
             * Create a new personal access token.
             */
            store() {
                this.currentTicket = null;

                this.form.errors = [];

                axios.post('/ticket/create', this.form)
                        .then(response => {
                            this.form.amount = '';
                            this.form.errors = [];

                            this.tickets.push(response.data.ticket);

                            this.showTicket(response.data.currentTicket);
                        })
                        .catch(error => {
                            if (typeof error.response.data === 'object') {
                                this.form.errors = _.flatten(_.toArray(error.response.data));
                            } else {
                                this.form.errors = ['Something went wrong. Please try again.'];
                            }
                        });
            },

            /**
             * Toggle the given scope in the list of assigned scopes.
             */
            /*toggleScope(scope) {
                if (this.scopeIsAssigned(scope)) {
                    this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                } else {
                    this.form.scopes.push(scope);
                }
            },*/

            /**
             * Determine if the given scope has been assigned to the token.
             */
            /*scopeIsAssigned(scope) {
                return _.indexOf(this.form.scopes, scope) >= 0;
            },*/

            /**
             * Show the given access token to the user.
             */
            showTicket(ticket) {
                $('#modal-create-ticket').modal('hide');

                this.ticket = ticket;

                $('#modal-ticket').modal('show');
            },

            /**
             * Revoke the given token.
             */
            revoke(ticket) {
                axios.delete('/ticket/delete/' + ticket.id)
                        .then(response => {
                            this.getTickets();
                        });
            }
        }
    }
</script>
