<div  class="modal fade" id="history-modal" tabindex="-1"  data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body p-0">
                        <span type="button" id="modal-close" class="btn-close position-absolute top-5 end-5" data-bs-dismiss="modal" style="z-index: 1;">
                            <i class="fas fa-times-circle fs-4" style="color: red !important;"></i>
                        </span>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="card px-5 py-5">
                                    <h4 class="text-center"><span id="customer-name"></span> Rental History</h4>
                                    <hr class="bg-dark "/>
                                    <table class="table" id="historyTable">
                                        <thead>
                                        <tr class="bg-light">
                                            <th>No</th>
                                            <th>Car Name</th>
                                            <th>Car Model</th>
                                            <th>Total Cost</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody id="historyList">
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>


async function getHistoryList(id) {
    showLoader();
    let res=await axios.post("/rental-history-by-id", {id:id});
    hideLoader();

    let tableData=$("#historyTable");
    let tableList=$("#historyList");
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
                    
                 </tr>`
        tableList.append(row)
    })


    new DataTable('#historyTable',{
        // info: false,
        paging: false,
        scrollY: 400,
    });

}


</script>

