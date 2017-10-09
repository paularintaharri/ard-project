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

                    <div class="alert alert-success" v-if="message !== ''">
                        <p>{{ message }}</p>
                    </div>

                    <!-- User's tickets -->
                    <table class="table table-borderless m-b-none" v-if="tickets.length > 0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Owner</th>
                                <th>Added</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="ticket in tickets">
                                <!-- Client Name -->
                                <td style="vertical-align: middle;">
                                    <a class="action-link text-primary" @click="showTicket(ticket)">
                                    {{ ticket.id }}
                                    </a>
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ ticket.user.name }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ ticket.created_at.date }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ ticket.amount }}
                                </td>

                                <!-- Delete Button -->
                                <td style="vertical-align: middle;">
                                    <a class="action-link text-danger" @click="deleteTicket(ticket)">
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
                                <label class="col-md-4 control-label">Street Address</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-street_address" type="text" class="form-control" name="street_address" v-model="form.street_address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Postal Code</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-postal_code" type="text" class="form-control" name="postal_code" v-model="form.postal_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-city" type="text" class="form-control" name="city" v-model="form.city">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Country</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-country" type="text" class="form-control" name="country" v-model="form.country">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Amount</label>

                                <div class="col-md-6">
                                    <input id="create-ticket-amount" type="text" class="form-control" name="amount" v-model="form.amount">
                                </div>
                            </div>
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

        <!-- Ticket Modal -->
        <div class="modal fade" id="modal-ticket" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" v-if="currentTicket">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Ticket {{ currentTicket.id }}
                        </h4>
                    </div>

                    <div class="modal-body">
                        <ul class="list-group" v-for="(value, key) in currentTicket">
                            <li class="list-group-item"><strong>{{ key }}: </strong>{{ value }}</li>
                        </ul>

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

                message: '',

                form: {
                    amount: '',
                    street_address: '',
                    postal_code: '',
                    city: '',
                    country: 'FI',
                    redirect: '',
                    errors: [],
                },
            };
        },

        computed: {
            userTickets: function () {
                return this.tickets.filter(function () {
                    return [];
                })
            }
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

                $('#modal-create-ticket').on('shown.bs.modal', () => {
                    $('#create-ticket-street_address').focus();
                });
            },

            /**
             * Get all of the tickets created by the user.
             */
            getTickets() {
                axios.get('/tickets')
                        .then(response => {
                            console.log(response);
                            this.tickets = response.data.data.tickets;
                        });
            },

            /**
             * Show the form for creating new tickets.
             */
            showCreateTicketForm() {
                $('#modal-create-ticket').modal('show');
            },

            /**
             * Create a new ticket.
             */
            store() {
                this.currentTicket = null;

                this.form.errors = [];

                axios.post('/tickets', this.form)
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
             * Show the given ticket to the user.
             */
            showTicket(ticket) {
                $('#modal-create-ticket').modal('hide');

                this.currentTicket = ticket;

                $('#modal-ticket').modal('show');
            },

            /**
             * Delete the given ticket.
             */
            deleteTicket(ticket) {
                axios.delete('/tickets/' + ticket.id)
                        .then(response => {
                            this.message = response.data.message;
                            this.getTickets();
                        });
            }
        }
    }
</script>
