<template>
  <div id="myModal" class="modal">
		<div class="modal-content">
			<div class="top">
				<div class="top-titles">
					<div class="title">{{modalTitle}}</div>
				</div>
			</div>
			<div class="modal-main-content" >
				{{modalContent}}
			</div>
			<div class="bottom">
				<div class="modal-btn">
					<s-button
                        :buttonText="'Cancel'"
                        @clickAction="closeModal"
                        style="float:right">
                    </s-button>
					<s-button
                        :buttonText="'Continue'"
                        @clickAction="continueModal"
                        style="float:right">
                    </s-button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
        data () {
            return {
            }
        },
        props: {
            modalContent: {
                type: String,
                required: true
            },
            modalTitle: {
                type: String,
                required: true
            },
            id: {
                type: Number,
                required: true
            }
        },
        methods: {
            openModal () {
                var modal = document.getElementById('myModal')
                modal.style.display = 'block'
            },
            continueModal (){
                this.$emit('confirmed', this.id)
                this.closeModal()
            },
            closeModal () {
                var modal = document.getElementById('myModal')
                modal.style.display = 'none'
            }
        }
    }
</script>

<style scoped>
.top{
  height: 70px;
}
.top div {
  display: inline-block;
  text-align: left;
}
.top-titles{
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow: auto;
}
.top-titles div {
  display: block;
  overflow: auto;
}

.title {
  font-weight: bold;
  font-size: 18px;
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-main-content {
  overflow: auto;
  height: 50px;
}
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  height: 200px;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.modal-btn {
  float: right;
}
.bottom {
  padding-top: 25px;
}
.bottom div{
  margin-right: 5px;
}

</style>
