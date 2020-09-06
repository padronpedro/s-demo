<template>
  <div>
    <div class="box-main-content">
        <div class="box-main-content-container">
            <div class="top-module">
               <s-bread-crumbs :listLink="breadCrumbs" />
                <s-button :buttonText="'Add a new member'" @clickAction="clickAddMember" style="float:right"></s-button>
            </div>

            <p v-if="(dataTable.length===0) && !loadingData">No members found</p>
            <div v-if="loadingData" class="loadingDatatable">
                Loading members list....
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
                            <td>{{dataTable.email}}</td>
                            <td>{{dataTable.position}}</td>
                            <td>{{dataTable.phone}}</td>
                            <td class="colActions">
                                <s-icon :name="'Edit'" :iconName="'edit'" @actionCalled="editMember(dataTable.id)"></s-icon>
                                <s-icon :name="'Delete'" :iconName="'delete'" @actionCalled="openConfirmDelete(dataTable.id)"></s-icon>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <snack-bar ref="snackbar" :textToShow="snackText"/>
    <modal ref="modalDetails" :modalTitle="modal.title" :modalContent="modal.content" :id="modal.id" @confirmed="deleteMember" />

  </div>
</template>

<script>
  export default {
    data () {
      return {
          loadingData: false,
          dataTable: [],
          dataTableHeader: [
              { name: 'Name' },
              { name: 'Email' },
              { name: 'Position' },
              { name: 'Phone' }
          ],
          snackText: '',
          modal: {
              title: '',
              content: '',
              id: 0,
          },
          breadCrumbs: [
                { text: 'Home', link: 'admin.home'},
                { text: 'Members', link: ''}
            ]
      }
    },
    mounted() {
        this.getDataTable()
    },
    methods: {
      clickAddMember () {
        this.$goRouter('admin.members.add')
      },
      getDataTable () {
          this.loadingData = true
          axios.get('/api/v1/members', {})
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
                this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error)
            })
      },
      editMember (id) {
        this.$goRouter('', null, '/admin/members/edit/' + id)
      },
      openConfirmDelete(id){
        this.modal.title = 'Delete member confirmation'
        this.modal.content = 'Do you want to delete this member ?'
        this.modal.id = id
        this.$refs.modalDetails.openModal()
      },
      deleteMember (id) {
          this.$refs.snackbar.showSnack('Deleting a member, wait a moment please', 'success')
          axios.delete('/api/v1/members/' + id, {})
            .then(response => {
                let info = response.data
                if(info.status === 'SUCCESS') {
                    this.$refs.snackbar.showSnack('Member deleted successfully', 'success')
                    this.getDataTable()
                } else {
                    this.$refs.snackbar.showSnack(info.message, 'error')
                }
            })
            .catch(error => {
                this.$refs.snackbar.showSnack(('Error getting members data') + ': ' + error)
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
