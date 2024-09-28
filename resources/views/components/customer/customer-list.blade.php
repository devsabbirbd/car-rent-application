<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Customer List</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-info">Create New Account</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

getList();

async function getList() {
    showLoader();
    let res=await axios.post("/customer-list");
    hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");
    let data=res.data['data'];

    tableData.DataTable().destroy();
    tableList.empty();

    data.reverse().forEach(function (item,index) {
        let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>${item['email']}</td>
                    <td>${item['mobile']}</td>
                    <td>${item['address']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn historyBtn btn-sm btn-outline-info">Rental History</button>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
        tableList.append(row)
    })

    $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
    })

    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
    })

    $('.historyBtn').on('click',function () {
        let id= $(this).data('id');
        let name=$(this).parent().parent().children('td').eq(1).text();
        $('#customer-name').text(name);
        getHistoryList(id);
        $("#history-modal").modal('show');
    })

    new DataTable('#tableData',{
        scrollY: 400,
        info: true,
        lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All'] 
        ]
    });

}


</script>

