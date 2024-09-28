<div class="container-fluid my-4">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
      
            <div class="row">
                <div class="align-items-center col">
                    <h4>Rental List</h4>
                </div>
                <div class="align-items-center col">
                    <button onclick="getList()" class="float-end btn m-0 bg-gradient-primary">Refresh Data</button>
                </div>
            </div>

            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Rental ID</th>
                    <th>Customer Name</th>
                    <th>Car Name</th>
                    <th>Car Brand</th>
                    <th>Total Cost</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
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
    let res=await axios.post("/rental-list");
    hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");
    let data=res.data['data'];

    tableData.DataTable().destroy();
    tableList.empty();

    data.forEach(function (item,index) {

        let statusClass, statusIcon
        switch (item.status) {
            case 'Ongoing':
                statusClass = 'bg-gradient-primary px-3';
                statusIcon = 'fa-spinner';
                break;
            case 'Completed':
                statusClass = 'bg-gradient-success';
                statusIcon = 'fa-check';
                break;
            case 'Canceled':
                statusClass = 'bg-gradient-danger px-3';
                statusIcon = 'fa-times';
                break;
            default:
                statusClass = '';
                statusIcon = '';
                break;
        }

        let row=`<tr class="row-item">
                    <td>${item['id']}</td>
                    <td>${item['user']['name']}</td>
                    <td>${item['car']['name']}</td>
                    <td>${item['car']['brand']}</td>
                    <td> <i class="fas fa-dollar-sign"></i>  ${item['total_cost']}</td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <span class="btn rounded-2 dropdown-toggle ${statusClass} p-2 my-3 text-white text-capitalize" type="button" data-bs-toggle="dropdown" >
                                <i class="fa ${statusIcon}"></i></i> ${item.status}
                            </span>

                            <input type="hidden" class="updateStatus" value="${item.status}">

                            <ul class="dropdown-menu" >
                                <li><button class="dropdown-item" data-value="Ongoing" data-class="bg-gradient-primary"><i class="fa fa-spinner"></i> Ongoing</button></li>
                                <li><button class="dropdown-item" data-value="Completed" data-class="bg-gradient-success"><i class="fa fa-check"></i> Completed</button></li>
                                <li><button class="dropdown-item" data-value="Canceled" data-class="bg-gradient-danger"><i class="fa fa-times"></i> Canceled</button></li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button class="updateBtn btn  my-2 bg-gradient-info me-2" data-id="${item['id']}">Update</button>
                        <button class="deleteBtn btn  my-2 bg-gradient-danger" data-id="${item['id']}">Delete </button>
                    </td>
                 </tr>`
        tableList.append(row)
    })



    $('.dropdown-item').on('click', function () {
            let selectedText = $(this).html(); 
            let selectedClass = $(this).data('class'); 
            let status=$(this).data('value');
            $(this).closest('.dropdown').find('.updateStatus').val(status);
            
            // Update the button content and class
            $(this).closest('.dropdown').find('.dropdown-toggle')
                .removeClass('bg-gradient-primary bg-gradient-success bg-gradient-danger px-3') 
                .addClass(selectedClass) 
                .html(selectedText); 
        });

    $('.deleteBtn').on('click', async function () {
            let id= $(this).data('id');
            $('#deleteID').val(id);
            $("#delete-modal").modal('show');
        })

    $('.updateBtn').on('click', async function () {
        let id= $(this).data('id'); 
        let status=$(this).closest('.row-item').find('.updateStatus').val();
        showLoader();
        res=await axios.post("/rental-status-update",{id:id, status:status});
        hideLoader();
        if(res.data['status']==='success'){
            successToast(res.data['message']);
            await getList();
        }
        else{
            errorToast(res.data['message']);
        }
        

        
    })  

    new DataTable('#tableData',{
        order: [[ 0, "desc" ]],
        info: true,
        lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All'] 
        ]
    });

}





</script>

