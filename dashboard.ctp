<?php
  $dashboardUserName = trim(@$currentUser['User']['first_name'] . ' ' . @$currentUser['User']['last_name']);
  if (empty($dashboardUserName)) {
    $dashboardUserName = @$currentUser['User']['name'] ?: @$currentUser['User']['username'];
  }
  $dashboardUserRole = @$currentUser['Role']['name'] ?: @$currentUser['User']['position'];
?>
<div class="row">
  <div class="col-md-12 text-center" style="margin-bottom:20px;">
    <h1 style="margin-bottom:0; font-size:28px;">Kabalikat Multi-Purpose Cooperative</h1>
    <h2 style="margin-top:8px; font-size:20px;">Welcome Back<?php echo !empty($dashboardUserName) ? ', ' . h($dashboardUserName) : ''; ?></h2>
    <?php if (!empty($dashboardUserRole)): ?>
    <p style="margin:6px 0 0; color:#555;">Position: <?php echo h($dashboardUserRole); ?></p>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-success">
          <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> MEMBERS</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4 col-md-offset-1">
            <div class="text-center">
              <canvas id="members-chart" width="200" height="200"/>
            </div>
          </div>
          <div class="col-md-6">
            <table class="table table-bordered table-striped" style="font-size:11px">
              <?php foreach($members as $key => $member): ?>
              <tr>
                <td class="uppercase" style="background:<?php echo $colors[$key] ?>; color:#FFF"><?php echo $member['name'] ?></td>
                <td class="text-right" style="width:60px"><?php echo (number_format(($member['count']/$totalMembers) * 100, 2)).'%' ?></td>
                <td class="text-right" style="width:60px"><?php echo number_format($member['count'],0) ?></td>
              </tr>
              <?php endforeach ?>
              <tr>
                <td class="text-right" colspan="2">TOTAL</td>
                <td class="text-right"><?php echo number_format($totalMembers,0) ?></td>
              </tr>
            </table>
          </div>  
            </div>
          </div>
      </div>
      
      
      <div class="panel panel-info">
          <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> LOANS</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="text-center">
                  <canvas id="loans-chart" width="200" height="200"/>
                </div>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped" style="font-size:11px">
                  <?php foreach($loans as $key => $loan): ?>
                  <tr>
                    <td class="uppercase" style="background:<?php echo $colors[$key] ?>; color:#FFF"><?php echo $loan['name'] ?></td>
                    <td class="text-right" style="width:60px"><?php echo (number_format(($loan['count']/$totalLoans) * 100, 2)).'%' ?></td>
                    <td class="text-right" style="width:60px"><?php echo number_format($loan['count'],0) ?></td>
                  </tr>
                  <?php endforeach ?>
                  <tr>
                    <td class="text-right" colspan="2">TOTAL</td>
                    <td class="text-right"><?php echo fnumber($totalLoans) ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      </div>

      <div class="panel panel-warning">
          <div class="panel-heading"><i class="fa fa-dot-circle-o"></i> SAVINGS</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="text-center">
                  <canvas id="savings-chart" width="200" height="200"/>
                </div>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped" style="font-size:11px">
                  <?php foreach($savings as $key => $save): ?>
                  <tr>
                    <td class="uppercase" style="background:<?php echo $colors[$key] ?>; color:#FFF"><?php echo $save['name'] ?></td>
                    <td class="text-right" style="width:60px"><?php echo (number_format(($save['count']/$totalSavings) * 100, 2)).'%' ?></td>
                    <td class="text-right" style="width:60px"><?php echo number_format($save['count'],0) ?></td>
                  </tr>
                  <?php endforeach ?>
                  <tr>
                    <td class="text-right" colspan="2">TOTAL</td>
                    <td class="text-right"><?php echo number_format($totalSavings,0) ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>



<script>
$(document).ready(function(){
  var memberData = [
    <?php foreach($members as $key => $member): ?>
      {
        value: <?php echo $member['count'] ?>,
        color: '<?php echo $colors[$key] ?>',
        highlight: "<?php echo $colors[$key] ?>",
        label: '<?php echo $member['name']?>'
      },
    <?php endforeach ?>
  ];
  var membersCanvas = document.getElementById("members-chart").getContext("2d");
  window.membersChart = new Chart(membersCanvas).Pie(memberData); 
  
  
  var loanData = [
    <?php foreach($loans as $key => $loan): ?>
      {
        value: <?php echo $loan['count'] ?>,
        color: '<?php echo $colors[$key] ?>',
        highlight: "<?php echo $colors[$key] ?>",
        label: '<?php echo $loan['name']?>'
      },
    <?php endforeach ?>
  ];
  var loansCanvas = document.getElementById("loans-chart").getContext("2d");
  window.membersChart = new Chart(loansCanvas).Pie(loanData); 
  
  var savingData = [
    <?php foreach($savings as $key => $save): ?>
      {
        value: <?php echo $save['count'] ?>,
        color: '<?php echo $colors[$key] ?>',
        highlight: "<?php echo $colors[$key] ?>",
        label: '<?php echo $save['name']?>'
      },
    <?php endforeach ?>
  ];
  var savingsCanvas = document.getElementById("savings-chart").getContext("2d");
  window.membersChart = new Chart(savingsCanvas).Pie(savingData); 
  
  
});

</script>