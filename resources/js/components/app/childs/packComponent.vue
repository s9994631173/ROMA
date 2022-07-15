<template>
    <div class="app">
		<div class="chapter">
			<table>
				<tr>
					<td><span class="centrtext">Поиск по названию вложения</span></td>
				</tr>
				<tr>
					<td><input id='item' v-model='searchItem' placeholder='поиск'/></td>
				</tr>
				<tr v-if="notfound">
					<td><span class="p-green">Я ничего не смог найти :(</span></td>
				</tr>
			</table>
		</div>

		<div class="chapter" v-if="recommends.length > 0">
				РЕКОМЕНДАЦИИ 
				<span class="p-green">кликни, чтобы выбрать</span>
				<div class="recommends">
					<div class="recommend" v-for="(item, index) in recommends" :key="index" @click="selectSearch(item)">
						<div class="itemName" style="font-weight: bold;"> {{item.itemName}} </div>
						<div class="text-small"> {{item.category}} </div>
						<div class="text-small"> {{item.char}} </div>
					</div>
				</div>
		</div>

		<div class="chapter">
			<table>
				<tr>
					<td><span class="centrtext">Поиск по категории вложения</span></td>
				</tr>
				<tr>
					<td><select class="select1" id="category" v-model="selectedCategory">
						<option>-</option>
						<option v-for="(item, index) in categorys" :key="index">{{ item.category }}</option>
					</select></td>
				</tr>
				<tr>
					<td><select class="select1" id="char" v-model="selectedChar" v-if="chars.length > 0">
						<option v-for="(char, index) in chars" :key="index">{{ char.char }}</option>
					</select></td>
				</tr>
			</table>

			<div class="info" v-if="aboutItem">
				<div class="p-green">Описание вложения:</div>
				<div v-html="aboutItem"></div>
			</div>

			<div class="info" v-if="pack">
				<div class="p-green">Подходящая упаковка:</div>
				<div>{{pack}}</div>
			</div>

			<div class="info" v-if="method">
				<div class="p-green">Подходящий метод упаковки:</div>
				<div v-html="method"></div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'

    export default {
		name: 'v-pack',
		data: function(){
			return{
				searchItem: null,
				categorys: [],
				chars: [],
				selectedCategory: null,
				selectedChar: null,

				aboutItem: null,
				method: null,
				pack: null,
				recommends: [],
				notfound: false,
			}
		},
		methods:{
			selectSearch: function(obj){
				this.selectedCategory = obj.category
				this.selectedChar = obj.char
			}
		},
		computed: {

		},
		watch: {
			selectedCategory (){
				axios.post('/api/pack/getChars', {
					category: this.selectedCategory
				})
				.then(response => {
					this.chars = response.data
					this.selectedChar = response.data[0].char
				})
			},
			searchItem (){
				this.recommends = []
				this.notfound = false

				if(this.searchItem.length>2){
					axios.post('/api/pack/presearch', {
						item: this.searchItem
					})
					.then(response => {
						if(response.data.length == 0){
							this.notfound = true
						}
						this.recommends = response.data
					})
				}
			},
			selectedChar (){
				axios.post('/api/pack/search', {
					char: this.selectedChar,
					category: this.selectedCategory
				})
				.then(response => {
					this.aboutItem = response.data[0].aboutItem
					this.method = response.data[0].method
					this.pack = response.data[0].pack
				})
			}
		},
		mounted(){
			axios.get('/api/pack/getAllCategorys')
			.then(response => {
				this.categorys = response.data
				this.searchItem = this.$route.query.value ? this.$route.query.value: null
			})
		}
    }
</script>