<div  class="modal fade" id="signup-modal" tabindex="-1"  data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="card px-2">
                    <div class="card-body">
                        <span type="button" id="modal-close" class="btn-close position-absolute top-5 end-5" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times-circle fs-4" style="color: red !important;"></i>
                        </span>
                        <form action="javascript:void(0)" id="registration-form">
                        <h4 class="text-center">SIGN UP</h4>
                        <br/>
                        <input id="registration-name" placeholder="Your Name" class="form-control" type="text"/>
                        <br/>
                        <input id="registration-mobile" placeholder="Your Mobile" class="form-control" type="text"/>
                        <br/>
                        <input id="registration-address" placeholder="Your Address" class="form-control" type="text"/>
                        <br/>
                        <input id="registration-email" placeholder="Your Email" class="form-control" type="email"/>
                        <br/>
                        <input id="registration-password" placeholder="Your Password" class="form-control" type="password"/>
                        <br/>
                        <button onclick="onRegistration()" class="btn w-100 bg-gradient-primary">Sign Up</button>
                        <br/>
                        <h6 class="text-center">OR</h6>
                        <a class="btn w-100 bg-gradient-info text-center" href="javascript:void(0)" data-bs-target="#login-modal" data-bs-toggle="modal">Login</a>
                    </form>
                    </div>
                </div>
            </div>
    </div>
</div>


<script>
    
  async function onRegistration() {
        let name = document.getElementById('registration-name').value;
        let email = document.getElementById('registration-email').value;
        let mobile = document.getElementById('registration-mobile').value;
        let address = document.getElementById('registration-address').value;
        let password = document.getElementById('registration-password').value;

        if(name.length===0){
            errorToast('Name is required')
        }else if(email.length===0){
            errorToast('Email is required')
        }else if(!email.includes('@')){
            errorToast('Please use a valid email address')
        } else if(password.length===0){
            errorToast('Password is required')
        }
        else{
            if(mobile.length===0){
                mobile='N/A';
            }
            if(address.length==0){
                address='N/A';
            }
            showLoader();
            let res=await axios.post("/signup",{
                name:name,
                email:email,
                mobile:mobile,
                address:address,
                password:password
            })
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                $("#signup-modal").modal('hide');
                $("#registration-form").trigger("reset");
                setTimeout(() => {
                    $("#login-modal").modal('show');
                    successToast("Login to continue");
                }, 1500);
                
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }
</script>