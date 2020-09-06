<template>
  <div>
    <div class="box-main-content">
        <div class="box-main-content-container">
            <div class="top-module">
                <s-bread-crumbs :listLink="breadCrumbs" />
                <s-button :buttonText="'Add a new client'" @clickAction="clickAddClient" style="float:right"></s-button>
            </div>

            <p v-if="(dataTable.length===0) && !loadingData">No clients found</p>
            <div v-if="loadingData" class="loadingDatatable">
                Loading clients list....
            </div>

            <div class="tabBox" v-if="dataTable.length>0">
                <table>
                    <thead>
                        <tr>
                            <th v-for="(oneItem,index) in dataTableHeader" :key="index">
                                {{oneItem.name}}
                            </th>
                            <th width="7%">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(dataTable,index) in dataTable" :key="index">
                            <td>{{dataTable.name}}</td>
                            <td>{{dataTable.contact}}</td>
                            <td>{{dataTable.phone}}</td>
                            <td>{{dataTable.email}}</td>
                            <td class="colActions cEditIcon">
                                <inline-svg
                                    :src="editIcon"
                                    width="30"
                                    height="30"
                                    fill="black"
                                    aria-label="editPro"
                                    @click="editClient(dataTable.id)"
                                ></inline-svg>
                                <inline-svg
                                    :src="deleteIcon"
                                    width="30"
                                    height="30"
                                    fill="black"
                                    aria-label="editPro"
                                    @click="openConfirmDelete(dataTable.id)"
                                ></inline-svg>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <snack-bar ref="snackbar" :textToShow="snackText"/>
    <modal ref="modalDetails" :modalTitle="modal.title" :modalContent="modal.content" :id="modal.id" @confirmed="deleteClient" />

  </div>
</template>

<script>
  export default {
    data () {
      return {
          editIcon: require('../../../assets/edit.svg'),
          deleteIcon: require('../../../assets/delete.svg'),
          loadingData: false,
          dataTable: [],
          dataTableHeader: [
              { name: 'Name' },
              { name: 'Contact' },
              { name: 'Phone' },
              { name: 'Email' }
          ],
          snackText: '',
          modal: {
              title: '',
              content: '',
              id: 0,
          },
          breadCrumbs: [
                { text: 'Home', link: 'home'},
                { text: 'Clients', link: ''}
            ]
      }
    },
    mounted() {
        this.getDataTable()
    },
    methods: {
      clickAddClient () {
        this.$goRouter('admin.clients.add')
      },
      getDataTable () {
          this.loadingData = true
          axios.get('/api/v1/clients', {})
            .then(response => {
                this.loadingData = false
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.dataTable = info.data
                } else {
                    this.$refs.snackbar.showSnack(info.message, 'error')
                }
            })
            .catch(error => {
                this.loadingData = false
                this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error, 'error')
            })
      },
      editClient (id) {
        this.$goRouter('', null, '/admin/clients/edit/' + id)
      },
      openConfirmDelete(id){
        this.modal.title = 'Delete client confirmation'
        this.modal.content = 'Do you want to delete this client ?'
        this.modal.id = id
        this.$refs.modalDetails.openModal()
      },
      deleteClient (id) {
          this.$refs.snackbar.showSnack('Deleting client, wait a moment please', 'success')
          axios.delete('/api/v1/clients/' + id, {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.$refs.snackbar.showSnack('Client deleted successfully', 'success')
                    this.getDataTable()
                } else {
                    this.$refs.snackbar.showSnack(info.message, 'error')
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting clients data') + ': ' + error, 'error')
            })
      }
    }
  }
</script>

<style scoped>
.top-module {
    padding: 10px;
    margin-bottom: 40px;
}
.top-module div {
    display: inline-block;
}



</style>
