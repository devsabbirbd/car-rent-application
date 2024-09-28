<div class="container-fluid px-10 my-4">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
      
            <h2 class="text-center">Rental History</h2>

            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Car Name</th>
                    <th>Car Model</th>
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
    let res=await axios.post("/rental-history");
    hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");
    let data=res.data['data'];

    tableData.DataTable().destroy();
    tableList.empty();

    data.reverse().forEach(function (item,index) {

        let statusClass, statusIcon, actionBtn;
        switch (item.status) {
            case 'Ongoing':
                statusClass = 'text-white bg-gradient-primary px-3';
                statusIcon = 'fa-spinner';
                actionBtn = 'd-inline-block';
                break;
            case 'Completed':
                statusClass = 'text-white bg-gradient-success';
                statusIcon = 'fa-check';
                actionBtn = 'd-none';
                break;
            case 'Canceled':
                statusClass = 'text-white bg-gradient-danger px-3';
                statusIcon = 'fa-times';
                actionBtn = 'd-none';
                break;
            default:
                statusClass = '';
                statusIcon = '';
                break;
        }

        let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['car']['name']}</td>
                    <td>${item['car']['model']}</td>
                    <td> <i class="fas fa-dollar-sign"></i>  ${item['total_cost']}</td>
                    <td>${item['start_date']}</td>
                    <td>${item['end_date']}</td>
                    <td class="text-center">
                        <span class="${statusClass} d-inline-block rounded-2 p-2 my-2 ">
                            <i class="fa ${statusIcon}"></i> ${item.status} 
                        </span>
                    </td>
                    <td>
                        <button data-id="${item['id']}" class="cancelBtn btn btn-outline-danger my-2 ${actionBtn}">Cancel Rental</button>
                    </td>
                 </tr>`
        tableList.append(row)
    })

    $('.cancelBtn').on('click',function () {
        let id= $(this).data('id');
        $("#cancel-modal").modal('show');
        $("#cancelID").val(id);
    })

    new DataTable('#tableData',{
        info: true,
        lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All'] 
        ]
    });

}


</script>

