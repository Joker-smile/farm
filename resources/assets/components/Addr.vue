<template>
    <div>
        <div class="change-address" v-bind:class="{ hide: !hasAddress }">
            <div class="now-add">
                <div class="men-s clearfix">
                    <span id="men-name">{{currentAddress.receiver}}</span>
                    <span id="men-num">{{currentAddress.phone}}</span>
                </div>
                <p class="men-address">{{currentAddress.address}}</p>
            </div>
            <div class="choose-add">
                <a v-on:click="changeAddr" class="ch_address">更换地址</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- 还未填写地址的 -->
        <div class="change-address" v-bind:class="{ hide: hasAddress }">
            <div class="now-add">
                <div class="men-s clearfix">
                    <span id="men-name">收货人：——</span>
                    <span id="men-num">手机号码：——</span>
                </div>
                <p class="men-address">收货地址：——</p>
            </div>
            <div class="choose-add">
                <a v-on:click="addAddr" class="add_address">添加地址</a>
            </div>
            <div class="clearfix"></div>
        </div>


        <div class="screen" v-bind:class="{ show: screen.status }">
            <div class="address-c">
                <div class="address-head">
                    <p>
                        <span v-on:click="changeAddr" v-bind:class="{ 'add-choose': screen.action == 'change' }">地址选择</span>
                        <span v-on:click="addAddr" v-bind:class="{ 'add-choose': screen.action == 'add' }">地址添加</span>
                        <span v-on:click="closeAddr" class="close"></span>
                    </p>
                </div>
                <ul  v-bind:class="{ hide: screen.action != 'change' }">
                    <li class="add0 clearfix" v-for="ad in address" :key="ad.id">
                        <span class="ch-ad" v-on:click="selectAddress(ad)" v-bind:class="{active : ad.id == currentAddress.id}"></span>
                        <div class="men-s">
                            <p><span id="men-name">{{ad.receiver}}</span></p>
                            <span id="men-num">{{ad.phone}}</span>
                        </div>
                        <p class="men-address">{{ad.address}}</p>
                    </li>
                </ul>
                <ul class="new-address" v-bind:class="{ hide: screen.action != 'add' }">
                    <li><p>收件人</p><input type="text" placeholder="请输入收件人的姓名" v-model="newAddress.receiver"/></li>
                    <li><p>手机号码</p><input type="text" placeholder="请输入收件人的电话号码" v-model="newAddress.phone" /></li>
                    <li><p>详细地址</p><input type="text" placeholder="请输入收件人的详细地址" v-model="newAddress.address" /></li>
                </ul>
                <a v-on:click="closeAddr" v-bind:class="{ hide: screen.action != 'change' }" class="affirm">确定</a>
                <a v-on:click="save" v-bind:class="{ hide: screen.action != 'add' }" class="affirm">确定</a>
            </div>
        </div>
    </div>

</template>

<script>
    import Bus from './bus.js';

    export default {
        data() {
            return {
                screen : {
                    status : false,
                    action : 'change'
                },
                address : [],
                currentAddress : {
                    id : '',
                    receiver : '',
                    phone : '',
                    address : ''
                },
                newAddress : {
                    receiver : '',
                    phone : '',
                    address : ''
                }
            }
        },
        created() {
            this.$http.get('/address').then(response => {
                return response.json();
            }).then(json => {
                this.address = json;
                if (this.address.length > 0){
                    this.currentAddress = this.address[0];
                }
            });
        },
        methods : {
            selectAddress(address){
                this.currentAddress = address;
            },
            closeAddr(){
                this.screen = {
                    status : false,
                    action : 'add'
                }
            },
            addAddr(){
                this.screen = {
                    status : true,
                    action : 'add'
                }
            },
            changeAddr(){
                this.screen = {
                    status : true,
                    action : 'change'
                }
            },
            save(){
                if (this.newAddress.receiver === '' || this.newAddress.phone === '' || this.newAddress.address === ''){
                    Bus.$emit('box', '请填写完整')
                }else{
                    Bus.$emit('loading', true);
                    this.$http.post('/address', this.newAddress).then(response => {
                        return response.json();
                    }).then(json => {
                        Bus.$emit('loading', false);
                        this.currentAddress = json;
                        this.address.push(json);
                        this.closeAddr();
                    });
                }
            }
        },
        computed : {
            hasAddress(){
                return this.address.length !== 0;
            }
        },
        watch : {
            currentAddress(val){
                Bus.$emit('address', val);
            },
            selected(selected){
                Bus.$emit('selected', selected);
            }
        }
    }
</script>