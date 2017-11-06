<template>
    <div>
        <div class="total-price">
            <div class="price">
                <p class="total-choose"><span v-on:click="all" class="all-check" v-bind:class="{ active: isAll() }"></span>全选</p>
                <p class="all-pay">总价：<strong class="total-cost">￥<span id="all_cost">{{total}}</span></strong></p>
            </div>
            <a v-on:click="pay">结算</a>
        </div>
        <div class="cart">
            <ul>
                <li v-for="(item, key) in items" :key="item.__raw_id">
                    <span v-on:click="select(item.__raw_id)" v-bind:class="{ active: isActive(item.__raw_id) }" class="_check"></span>
                    <div class="cart-head">
                        <p class="cart-name">{{item.name}}</p>
                        <p class="cart-price">￥<span>{{item.price}}</span></p>
                    </div>
                    <div class="cart-body clearfix">
                        <div class="cart-photo">
                            <img :src="item.options.thumb[1]" alt="" />
                        </div>
                        <div class="add-num">
                            <span v-on:click="sub(item.__raw_id)" class="sub">-</span>
                            <input type="text" :value="item.qty" class="num" />
                            <span v-on:click="add(item.__raw_id)" class="add">+</span>
                        </div>
                        <a v-on:click="remove(key)" class="delete">删除</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    import Bus from './bus.js';

    export default {
        data() {
            return {
                items : [],
                selected : [],
                address : null
            }
        },
        created() {
            if (window.items.length > 0){
                this.items = window.items;
                console.log(this.items);
            }

            Bus.$emit('loading', false);

            Bus.$on('selected', (json) => {
                this.selected = selected;
            });
            Bus.$on('address', (address) => {
                this.address = address;
            });
        },
        methods : {
            all(){
                if (this.isAll()){
                    this.selected = [];
                }else{
                    let all = [];

                    for (var i = 0; i < this.items.length; i++){
                        all.push(this.items[i].__raw_id);
                    }

                    this.selected = [...new Set(this.selected.concat(all))];
                }
            },
            isAll(){
                return this.selected.length === this.items.length;
            },
            isActive(rawId){
                return this.selected.includes(rawId);
            },
            select(rawId) {
                if (this.selected.includes(rawId)){
                    let index = this.selected.indexOf(rawId);
                    this.selected.splice(index, 1);
                }else{
                    this.selected.push(rawId);
                }
            },
            remove(key) {
                Bus.$emit('loading', true);
                let item = this.items[key];
                this.$http.delete('/cart/'+item.__raw_id).then(response => {
                    Bus.$emit('loading', false);
                    return response.json();
                }).then(json => {
                    if (json.status){
                        this.items.splice(key, 1);
                        //this.$delete(this.items, rawId, null);
                    }
                });
            },
            add(rawId) {
                let item = this.getItem(rawId);

                let options = {
                    raw_id : rawId,
                    qty : item.qty + 1,
                };
                Bus.$emit('loading', true);
                this.$http.put('/cart',options).then(response => {
                    return response.json();
                }).then(json => {
                    Bus.$emit('loading', false);
                    if (json.status){
                        item.qty++;
                    }
                });
            },
            sub(rawId) {
                let item = this.getItem(rawId);

                if (item.qty === 1){
                    return;
                }
                let options = {
                    raw_id : rawId,
                    qty : item.qty - 1,
                };
                Bus.$emit('loading', true);
                this.$http.put('/cart',options).then(response => {
                    return response.json();
                }).then(json => {
                    Bus.$emit('loading', false);
                    if (json.status){
                        item.qty--;
                    }
                });
            },
            pay(){
                if (this.selected.length === 0){
                    Bus.$emit('box','请选择一件商品');
                    return;
                }
                if (this.address === null){
                    Bus.$emit('box','请设置收货地址');
                    return;
                }

                let params = {
                    selected : this.selected,
                    address : this.address
                };
                Bus.$emit('loading', true);
                this.$http.post('/orders',params).then(response => {
                    return response.json();
                }).then(ret => {
                    Bus.$emit('loading', false);
                    if (ret.status){
                        var config = JSON.parse(ret.json);
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest', config,
                            function(res){
                                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                    Bus.$emit('box', '支付成功');

                                    setTimeout(function () {
                                        window.location.href = '/orders/success';
                                    }, 1500);
                                }else{
                                    Bus.$emit('box', '支付失败');
                                }
                            }
                        );
                    }else{
                        Bus.$emit('box', '未知错误，稍后再试');
                    }
                });
            },
            getItem(rawId){
                for (let j = 0; j < this.items.length; j++){
                    if (this.items[j].__raw_id === rawId){
                        return this.items[j];
                    }
                }
            }
        },
        computed : {
            total(){
                let total = 0;

                for (let i = 0; i < this.selected.length; i++){
                    let item = this.getItem(this.selected[i]);

                    total = total + item.price * item.qty;
                }

                return total;
            }
        }
    }
</script>