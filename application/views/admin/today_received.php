<?php
include_once APPPATH . "views/partials/header.php";

// --- DUMMY DATA - REMOVE AND LOAD FROM YOUR CONTROLLER ---
// Controller should pass $share, an array of shareholder objects.
// Each object should have 'share_id', 'share_name', 'share_mobile', 'share_email', 'share_sex', 'share_dob'.
// if (!isset($share)) {
//     $share = [
//         (object)['share_id' => 1, 'share_name' => 'Alice Wonderland', 'share_mobile' => '0712345001', 'share_email' => 'alice@example.com', 'share_sex' => 'female', 'share_dob' => '1985-06-15'],
//         (object)['share_id' => 2, 'share_name' => 'Bob The Builder', 'share_mobile' => '0712345002', 'share_email' => 'bob@example.com', 'share_sex' => 'male', 'share_dob' => '1978-11-02'],
//     ];
// }
// --- END DUMMY DATA ---header.php
?>


<div class="w-full lg:ps-64">
  <div class="= overflow-x-auto">


<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="w-full">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                              
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" 
							placeholder="tafuta mteja hapa"
        data-hs-datatable-search="#shareholder_table"
        aria-label="Search share holders"
							>
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
      <?php
      $pdf_from = !empty($filter_from) ? $filter_from : date('Y-m-d');
      $pdf_to = !empty($filter_to) ? $filter_to : date('Y-m-d');
      $pdf_blanch_id = !empty($selected_blanch_id) ? $selected_blanch_id : 'all';
      $pdf_url = base_url('admin/print_received_deposit?from=' . urlencode($pdf_from) . '&to=' . urlencode($pdf_to) . '&blanch_id=' . urlencode((string) $pdf_blanch_id) . '&empl_id=all');
      ?>
				<button type="button" class="flex items-center justify-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal">
    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V4z" clip-rule="evenodd" />
    </svg>
    Filter Data
</button>

      <?php if (!empty($received)) { ?>
      <a href="<?php echo $pdf_url; ?>" target="_blank" class="flex items-center justify-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none dark:focus:ring-red-800">
        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h3v-2H4V5h12v10h-3v2h3a2 2 0 002-2V8l-4-5H4zm8 0v4h4"/>
          <path d="M9 11h2v3h2l-3 3-3-3h2v-3z"/>
        </svg>
        Download PDF
      </a>
      <?php } ?>

                  
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="shareholder_table"  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-cyan-500 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 dark:text-white">S/No</th>
							<th scope="col" class="px-4 py-3 dark:text-white">Customer Name</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">Branch Name</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">Phone Number</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">Duration Type</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">Loan Amount</th>
							<th scope="col" class="px-4 py-3 dark:text-white">Received Amount</th>
							<th scope="col" class="px-4 py-3 dark:text-white">Pay Method</th>
                            <th scope="col" class="px-4 py-3 dark:text-white">Employee</th>
							<th scope="col" class="px-4 py-3 dark:text-white">Date</th>
              <th scope="col" class="px-4 py-3 dark:text-white">Action</th>
                           
                         
						
							  
                        </tr>
                    </thead>
					<tbody>
    <?php 
    $no = 1; 
    $total_loan = 0;
    $total_received = 0;
    ?>
    <?php foreach($received as $today_recevables): 
        $total_loan += $today_recevables->loan_int;
        $total_received += $today_recevables->depost;
    ?>
        <tr class="border-b dark:border-gray-700">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $no++ ?></th>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->f_name . ' ' . $today_recevables->m_name . ' ' . $today_recevables->l_name; ?></td>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->blanch_name; ?></td>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->phone_no; ?></td>
            <td class="px-4 py-3 dark:text-white">
                <?php 
                    if ($today_recevables->day == 1) echo "Daily";
                    elseif ($today_recevables->day == 7) echo "Weekly";
                    elseif (in_array($today_recevables->day, [28, 29, 30, 31])) echo "Monthly";
                ?>
            </td>
            <td class="px-4 py-3 dark:text-white"><?= number_format($today_recevables->loan_int); ?></td>
            <td class="px-4 py-3 dark:text-white"><?= number_format($today_recevables->depost); ?></td>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->account_name; ?></td>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->empl_username; ?></td>
            <td class="px-4 py-3 dark:text-white"><?= $today_recevables->depost_day; ?></td>
            <td class="px-4 py-3 dark:text-white">
                <?php if (!empty($today_recevables->dep_id)) { ?>
                <a href="<?php echo base_url("admin/delete_depost_data/{$today_recevables->dep_id}") ?>" data-customer-name="<?php echo htmlspecialchars(trim($today_recevables->f_name . ' ' . $today_recevables->m_name . ' ' . $today_recevables->l_name), ENT_QUOTES, 'UTF-8'); ?>" class="delete-transaction-link py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                  <svg class="delete-icon w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0h8m-8 0a1 1 0 01-1-1V5a1 1 0 011-1h6a1 1 0 011 1v1"/>
                  </svg>
                  <span class="delete-label"><?php echo $this->lang->line('delete'); ?></span>
                  <span class="delete-loader hidden w-5 h-5" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="20" height="20" style="display:block;background:transparent;">
                      <circle cx="50" cy="50" fill="none" stroke="currentColor" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                      </circle>
                    </svg>
                  </span>
                </a>
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <!-- Totals Row -->
    <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
        <td colspan="5" class="px-4 py-3 dark:text-white text-right">Total</td>
        <td class="px-4 py-3 dark:text-white"><?= number_format($total_loan); ?></td>
        <td class="px-4 py-3 dark:text-white"><?= number_format($total_received); ?></td>
        <td colspan="4"></td>
    </tr>
</tbody>

                </table>
				<div id="hs-basic-modal" class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-80 opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
  <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
          Filter Employee
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-basic-modal">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
    <?php echo form_open("admin/today_transactions", array('method' => 'get')); ?>
  <div class="p-4 overflow-y-auto space-y-4">

    <!-- Gender Dropdown -->
    <div>
      <label for="blanch" class="block text-sm font-medium text-gray-700 dark:text-white">Chagua Tawi</label>
      <select  id="branchSelect" name="blanch_id"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" data-live-search="true">
    <option value="all">All Branches</option>
    <option value="">Chagua Tawi</option>
			<?php foreach ($blanch as $blanchs): ?>
		<option value="<?php echo $blanchs->blanch_id; ?>"><?php echo $blanchs->blanch_name; ?> </option>
			<?php endforeach; ?>
      </select>
    </div>

    <!-- 2-Column Grid: Phone, Email, Company Name, Address -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Company Name -->
	  <?php $date = date("Y-m-d"); ?>  
      <?php $active_from = !empty($filter_from) ? $filter_from : $date; ?>
      <?php $active_to = !empty($filter_to) ? $filter_to : $date; ?>

      <div>
        <label for="company" class="block text-sm font-medium text-gray-700 dark:text-white">Kwanzia Tarehe</label>
		<input type="date" value="<?php echo $active_from; ?>" name="from"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      </div>

      <!-- Address -->
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white">Mpaka Tarehe</label>
  		<input type="date" name="to" value="<?php echo $active_to; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      </div>
    </div>

  </div>

  <!-- Modal Footer Buttons -->
  <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-basic-modal">
      Close
    </button>
    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
      Apply Filters
    </button>
  </div>
  <?php echo form_close(); ?>


    </div>
  </div>
</div>

            </div>
          
        </div>
    </div>
    </section>

	</div>
  </div>

<div id="delete-confirm-modal" class="hidden fixed inset-0 z-[90] flex items-center justify-center bg-black/50 p-4">
  <div class="w-full max-w-md min-h-[260px] rounded-xl bg-white p-5 shadow-xl dark:bg-gray-800">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Thibitisha Kufuta</h3>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Una uhakika unataka kufuta transaction ya mteja <span id="delete-customer-name" class="font-semibold text-gray-900 dark:text-white"></span>?</p>

    <div class="mt-5 flex items-center justify-end gap-2">
      <button type="button" id="cancel-delete-btn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
        Cancel
      </button>
      <button type="button" id="confirm-delete-btn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700">
        <span id="confirm-delete-label">Delete</span>
        <span id="confirm-delete-loader" class="hidden w-5 h-5" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="20" height="20" style="display:block;background:transparent;">
            <circle cx="50" cy="50" fill="none" stroke="currentColor" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
          </svg>
        </span>
      </button>
    </div>
  </div>
</div>


  <?php
  include_once APPPATH . "views/partials/footer.php";
  ?>

<script>
$(document).ready(function(){
$('#blanch').change(function(){
var blanch_id = $('#blanch').val();
//alert(blanch_id)
if(blanch_id != ''){

$.ajax({
url:"<?php echo base_url(); ?>admin/fetch_employee_blanch_deposit",
method:"POST",
data:{blanch_id:blanch_id},
success:function(data)
{
$('#empl').html(data);
//$('#district').html('<option value="">All</option>');
}
});
}
else
{
$('#empl').html('<option value="">Select Employee</option>');
//$('#district').html('<option value="">All</option>');
}
});

});
</script>


  <?php // Script for cmd+a fix for DataTables search input (if used) ?>
  <script>
$(document).ready(function() {
    $('#shareholder_table').DataTable({
        // optional: set to false if you don’t want it
        searching: true,
        paging: true,
        info: false
    });
});
</script>

  <script>
document.getElementById('simple-search').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const table = document.getElementById('shareholder_table');
    const trs = table.getElementsByTagName('tr');

    // Start from 1 to skip the header row
    for (let i = 1; i < trs.length; i++) {
        const tr = trs[i];
        const text = tr.textContent.toLowerCase();
        if (text.indexOf(filter) > -1) {
            tr.style.display = '';
        } else {
            tr.style.display = 'none';
        }
    }
});
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
.select2-container--default .select2-selection--single {
    background-color: #1f2937;
    border: 1px solid #374151;
    border-radius: 0.5rem;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    height: auto;
    color: #06b6d4; 
    font-size: 0.875rem;
    position: relative;
}
.select2-selection__rendered,
.select2-selection__clear,
.select2-selection__arrow {
    color: #d1d5db;
}
.select2-selection__arrow {
    right: 1rem;
    top: 0;
    width: 1.5rem;
    position: absolute;
}
.select2-selection__clear {
    right: 2.5rem;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
}
.custom-select2-dropdown {
    background-color: #1f2937;
    color: #d1d5db;
    border: 1px solid #374151;
    border-radius: 0.5rem;
    padding: 0.5rem;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #ffffff !important; /* Force white text */
}
.custom-select2-dropdown .select2-results__option--highlighted {
    background-color: #06b6d4 !important; /* Tailwind cyan-400 */
    color: #ffffff !important;
}

/* White text in the dropdown input if searchable */
.select2-search__field {
    color: #ffffff !important;
    background-color: #1f2937 !important; /* match dark bg */
    border: 1px solid #374151;
}
.custom-select2-dropdown .select2-results__option--highlighted {
    background-color: #06b6d4;
    color: #ffffff;
}
.custom-select2-container { margin: 0; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        HSStaticMethods.autoInit(); // This is required to initialize all hs-select dropdowns
    });
</script>
<script>
window.addEventListener('load', () => {
  setTimeout(() => {
    const inputs = document.querySelectorAll('input[data-hs-datatable-search]');
    inputs.forEach((input) => {
      input.addEventListener('keydown', function (evt) {
        if ((evt.metaKey || evt.ctrlKey) && (evt.key === 'a' || evt.key === 'A')) {
          this.select();
        }
      });
    });
    // HSStaticMethods.autoInit(['select']); // If Preline selects need explicit init
  }, 500);
});
</script>

<script>
$(document).ready(function () {
    const selectConfig = {
        placeholder: "Select",
        allowClear: true,
        width: '100%',
        dropdownCssClass: 'custom-select2-dropdown',
        containerCssClass: 'custom-select2-container'
    };

    $('#branchSelect').select2({...selectConfig, placeholder: "Select Branch"});
});

// Age Calculation
function getAge(dob) {
    const age = new Date().getFullYear() - new Date(dob).getFullYear();
    document.getElementById('age').value = isNaN(age) ? '' : age;
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteLinks = document.querySelectorAll('.delete-transaction-link');
  const modal = document.getElementById('delete-confirm-modal');
  const cancelBtn = document.getElementById('cancel-delete-btn');
  const confirmBtn = document.getElementById('confirm-delete-btn');
  const confirmLabel = document.getElementById('confirm-delete-label');
  const confirmLoader = document.getElementById('confirm-delete-loader');
  const customerNameLabel = document.getElementById('delete-customer-name');
  let pendingDeleteLink = null;

  function openModal() {
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }

  function closeModal() {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    confirmBtn.classList.remove('pointer-events-none', 'opacity-70');
    confirmLabel.classList.remove('hidden');
    confirmLoader.classList.add('hidden');
    if (customerNameLabel) {
      customerNameLabel.textContent = '';
    }
  }

  deleteLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault();
      pendingDeleteLink = this;
      if (customerNameLabel) {
        customerNameLabel.textContent = this.getAttribute('data-customer-name') || 'Unknown Customer';
      }
      openModal();
    });
  });

  cancelBtn.addEventListener('click', function () {
    pendingDeleteLink = null;
    closeModal();
  });

  modal.addEventListener('click', function (event) {
    if (event.target === modal) {
      pendingDeleteLink = null;
      closeModal();
    }
  });

  confirmBtn.addEventListener('click', function () {
    if (!pendingDeleteLink) {
      closeModal();
      return;
    }

    const icon = pendingDeleteLink.querySelector('.delete-icon');
    const label = pendingDeleteLink.querySelector('.delete-label');
    const loader = pendingDeleteLink.querySelector('.delete-loader');

    pendingDeleteLink.classList.add('pointer-events-none', 'opacity-70');
    if (icon) icon.classList.add('hidden');
    if (label) label.classList.add('hidden');
    if (loader) loader.classList.remove('hidden');

    confirmBtn.classList.add('pointer-events-none', 'opacity-70');
    confirmLabel.classList.add('hidden');
    confirmLoader.classList.remove('hidden');

    window.location.href = pendingDeleteLink.getAttribute('href');
  });
});
</script>