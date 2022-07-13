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
					<div class="recommend" v-for="(item, index) in recommends" :key="index" @click="selectSearch({category: item.category, char: item.char})">
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
					<td><select class="select1" id="category" @change="selectCategory($event)">
						<option>-</option>
						<option v-for="(item, index) in categorys" :key="index">{{ item.category }}</option>
					</select></td>
				</tr>
				<tr>
					<td><select class="select1" id="char" @change="selectChar($event)" v-if="chars.length > 0">
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
				searchItem: this.$route.query.value,
				categorys: [],
				selectedCategory: null,
				chars: [],
				selectedChar: null,
				aboutItem: null,
				method: null,
				pack: null,
				recommends: [],
				notfound: false
			}
		},
		methods:{
			selectCategory: function(data){
				this.selectedCategory = data.target.value
				let form = new FormData();
				form.append('category', data.target.value)
				var config = {
				method: 'post',
				url: '/api/pack/char',
				data : form
				};
				axios(config)
				.then(response => {
					this.chars = response.data
					this.selectedChar = response.data[0].char
				})
			},
			selectChar: function(data){
				this.selectedChar = data.target.value
			},
			selectSearch: function(obj){
				this.selectedCategory = obj.category
				this.selectedChar = obj.char
			}
		},
		computed: {
			final: function(){
				let form = new FormData();
				form.append('char', this.selectedChar)
				form.append('category', this.selectedCategory);

				fetch('/api/pack/final', {
					method: 'POST',
					body: form
				})
				.then(response => response.json())
				.then(response => {
					this.aboutItem = response[0].aboutItem
					this.method = response[0].method
					this.pack = response[0].pack
				})
				return
			},
			search: function(){
				this.recommends = []
				this.notfound = false

				if(this.searchItem.length>2){
					let form = new FormData();
					form.append('item', this.searchItem)
					fetch('/api/pack/search', {
						method: 'POST',
						body: form
					})
					.then(response => response.json())
					.then(response => {
						console.log(response.length)
						if(response.length == 0){
							this.notfound = true
						}
						this.recommends = response
					})
				}
				return
			}
		},
		mounted(){
			axios.get('/api/pack/categorys')
			.then(response => {
				this.categorys = response.data
			})
		}
    }
</script>