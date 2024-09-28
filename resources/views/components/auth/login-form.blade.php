<div  class="modal fade" id="login-modal" tabindex="-1"  data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="card px-2">
                    <div class="card-body">
                        <span type="button" class="btn-close position-absolute top-5 end-5" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times-circle fs-4" style="color: red !important;"></i>
                        </span>
                        
                        <h4 class="text-center">SIGN IN</h4>
                        <br/>
                        <input id="login-email" placeholder="User Email" class="form-control" type="email"/>
                        <br/>
                        <input id="login-password" placeholder="User Password" class="form-control" type="password"/>
                        <br/>
                        <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary mb-2">Login</button>
                        <br/>
                        <h6 class="text-center">OR</h6>
                        <a class="btn w-100 bg-gradient-info text-center" href="javascript:void(0)" data-bs-target="#signup-modal" data-bs-toggle="modal">Sign Up </a>
                    </div>
                </div>
            </div>
    </div>
</div>



<script>

  async function SubmitLogin() {
            let email=document.getElementById('login-email').value;
            let password=document.getElementById('login-password').value;

            if(email.length===0){
                errorToast("Email is required");
            }
            else if(password.length===0){
                errorToast("Password is required");
            }
            else{
                showLoader();
                let res=await axios.post("/login",{email:email, password:password});
                hideLoader()
                console.log(res);
                
                if(res.status===200 && res.data['status']==='success'){
                   successToast(res.data['message']);
                   setTimeout(() => {
                    window.location.href="{{url('/dashboard')}}";
                   }, 500);
                }
                else{
                    errorToast(res.data['message']);
                }
            }
    }

</script>