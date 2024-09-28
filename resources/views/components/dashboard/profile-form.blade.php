<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Update Customer Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Full Name</label>
                                <input id="name" placeholder=" Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Address</label>
                                <input id="address" placeholder="Address" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-info">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getProfile();
    async function getProfile(){
        showLoader();
        let res=await axios.post("/profile-details")
        hideLoader();
        if(res.status===200 && res.data['status']==='success'){
            let data=res.data['data'];
            document.getElementById('email').value=data['email'];
            document.getElementById('name').value=data['name'];
            document.getElementById('mobile').value=data['mobile'];
            document.getElementById('address').value=data['address'];
        }
        else{
            errorToast(res.data['message'])
        }

    }

    async function onUpdate() {


        let name = document.getElementById('name').value;
        let address = document.getElementById('address').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(name.length===0){
            errorToast('Name is required')
        }
        else if(password.length===0){
            errorToast('Password is required')
        }
        else{
            showLoader();
            let res=await axios.post("/profile-update",{
                name:name,
                mobile:mobile,
                address:address,
                password:password
            })
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                await getProfile();
                document.getElementById('password').value='';
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }

</script>

