	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="creditworthiness-heading">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#creditworthiness" aria-expanded="false" aria-controls="creditworthiness">
          <img src="http://wisercapital.com/images/icons/wsar.png" /> Creditworthiness 
        </a>
        <div class="pull-right"><span style="font-size: 22px; color: purple;">0</span>/400</div>
      </h4>
    </div>
    <div id="creditworthiness" class="panel-collapse collapse" role="tabpanel" aria-labelledby="creditworthiness-heading">
    <div class="panel-body">
    	
    	
    	{!! Form::open(array('route' => array('hf.update', $site->id), 'method' => 'put')) !!}
			    				
				            
	
		
		
		<div class="row">
			<div class="col-lg-9">
				Business Financial Strength	
			</div>			    
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-1">
				<span class="accordion-wsar-score">0</span>/200
			</div>
		</div>
			
			
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('creditworthinesss_status', 'Status') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('creditworthinesss_status', ['green check' => 'Green Check', 'red x' => 'Red X', 'red i' => 'Red I'], (empty($metas['creditworthinesss_status']) ? '' : $metas['creditworthinesss_status']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>

		
		<div class="row">
			<div class="col-lg-12">
					{!! Form::label('yr_1_income_before_tax', 'Profitability (Year 1 is most current year)') !!} 
	    	</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_income_before_tax', (isset($metas['yr_1_income_before_tax']) ? $metas['yr_1_income_before_tax'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Net Income before tax</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_2_income_before_tax', (isset($metas['yr_2_income_before_tax']) ? $metas['yr_2_income_before_tax'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 2 Net Income before tax</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_3_income_before_tax', (isset($metas['yr_3_income_before_tax']) ? $metas['yr_3_income_before_tax'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 3 Net Income before tax</span>
				</div>
			</div>
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/40
			</div>			
	    
	    </div>
	    
	    
	    <div class="row">
			<div class="col-lg-12">
				{!! Form::label('yr_1_total_liabilities', 'Debt/Equity Ratio') !!} 
	    	</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_total_liabilities', (isset($metas['yr_1_total_liabilities']) ? $metas['yr_1_total_liabilities'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Total Liabilities</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_total_equity', (isset($metas['yr_1_total_equity']) ? $metas['yr_1_total_equity'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Total Equity</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		&nbsp;
			</div>
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/40
			</div>			
	    
	    </div>
	    
	    
	    <div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('type_of_business', 'Type of business') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('type_of_business', $type_of_business, (empty($metas['type_of_business']) ? '' : $metas['type_of_business']), array('placeholder' => '[Select]', 'class' => 'form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		
		<div class="row">
			<div class="col-lg-12">
					{!! Form::label('yr_1_current_asset', 'Liquidity') !!} 
	    	</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_current_assets', (isset($metas['yr_1_current_assets']) ? $metas['yr_1_current_assets'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Current Assets</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_current_liabilities', (isset($metas['yr_1_current_liabilities']) ? $metas['yr_1_current_liabilities'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Current Liabilities</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('3_month_operating_expenses', (isset($metas['3_month_operating_expenses']) ? $metas['3_month_operating_expenses'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">3 months operating expenses</span>
				</div>
			</div>
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/20
			</div>			
	    
	    </div>
	    
	    
	    <div class="row">
			<div class="col-lg-12">
					{!! Form::label('yr_1_fixed_charges', 'Debt Services Ratio') !!} 
	    	</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_fixed_charges', (isset($metas['yr_1_fixed_charges']) ? $metas['yr_1_fixed_charges'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 Fixed Charges</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_ebitda', (isset($metas['yr_1_ebitda']) ? $metas['yr_1_ebitda'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr 1 EBITDA</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_debt_service', (isset($metas['yr_1_debt_service']) ? $metas['yr_1_debt_service'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr1 Debt Service</span>
				</div>
			</div>
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/40
			</div>			
	    
	    </div>
	    
	    
	    
	    
	     <div class="row">
			<div class="col-lg-12">
					{!! Form::label('yr_1_general_admin_expenses', '3 Year Trend (Year 1 is most current year)') !!} 
	    	</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_general_admin_expenses', (isset($metas['yr_1_general_admin_expenses']) ? $metas['yr_1_general_admin_expenses'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr1 General & Admin Expenses</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_2_general_admin_expenses', (isset($metas['yr_2_general_admin_expenses']) ? $metas['yr_2_general_admin_expenses'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr2 General & Admin Expenses</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_3_general_admin_expenses', (isset($metas['yr_3_general_admin_expenses']) ? $metas['yr_3_general_admin_expenses'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr3 General & Admin Expenses</span>
				</div>
			</div>
			
			
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/20
			</div>			
	    
	    </div>
	    
	    
	     <div class="row">
			
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_gross_sales', (isset($metas['yr_1_gross_sales']) ? $metas['yr_1_general_admin_expenses'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr1 Gross Sales</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_2_gross_sales', (isset($metas['yr_2_gross_sales']) ? $metas['yr_2_gross_sales'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr2 Gross Sales</span>
				</div>
			</div>
			
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_3_gross_sales', (isset($metas['yr_3_gross_sales']) ? $metas['yr_3_gross_sales'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr3 Gross Sales</span>
				</div>
			</div>
			
			
			
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/20
			</div>			
	    
	    </div>
	    
	    
	    <div class="row">
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_cost_of_goods', (isset($metas['yr_1_cost_of_goods']) ? $metas['yr_1_cost_of_goods'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr1 Gross Sales</span>
				</div>
			</div>
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_2_cost_of_goods', (isset($metas['yr_2_cost_of_goods']) ? $metas['yr_2_cost_of_goods'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr2 Gross Sales</span>
				</div>
			</div>
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_3_cost_of_goods', (isset($metas['yr_3_cost_of_goods']) ? $metas['yr_3_cost_of_goods'] : ''), array('class' => 'input-sm form-control'))  !!}
			    	<span class="help-block">Yr3 Gross Sales</span>
				</div>
			</div>
		<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-2">
				<span class="accordion-wsar-score">0</span>/20
			</div>			
	    </div>
	    
	    
	    <div class="row">
			<div class="col-lg-9">
				History & Long Term Viability
			</div>			    
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-1">
				<span class="accordion-wsar-score">0</span>/100
			</div>
		</div>
		
		
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('financial_reports_audited', 'Are Financial Reports Audited?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('financial_reports_audited', ['1' => 'Yes', '0' => 'No'], (empty($metas['financial_reports_audited']) ? '' : $metas['financial_reports_audited']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('financial_reports_reviewed_audited_compiled_by_outside_cpa', 'Were Financial Reports reviewed or compiled by an outside CPA?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('financial_reports_audited', ['1' => 'Yes', '0' => 'No'], (empty($metas['financial_reports_reviewed_audited_compiled_by_outside_cpa']) ? '' : $metas['financial_reports_reviewed_audited_compiled_by_outside_cpa']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
	    <div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('tax_returns_obtained_through_4506_process_vetted', 'Have the “As filed” tax returns been obtained from the IRS through the 4506 process and vetted against the client prepared financial reports?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('tax_returns_obtained_through_4506_process_vetted', ['1' => 'Yes', '0' => 'No'], (empty($metas['tax_returns_obtained_through_4506_process_vetted']) ? '' : $metas['tax_returns_obtained_through_4506_process_vetted']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
	    
	    <div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('acceptable_recent_third_party_inventory_audit', 'Is there an acceptable, recent third party Inventory audit?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('acceptable_recent_third_party_inventory_audit', ['1' => 'Yes', '0' => 'No'], (empty($metas['acceptable_recent_third_party_inventory_audit']) ? '' : $metas['acceptable_recent_third_party_inventory_audit']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('acceptable_ar_audit_with_aging_chargeoffs', 'Is there an acceptable AR audit with aging and chargeoffs?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('acceptable_ar_audit_with_aging_chargeoffs', ['1' => 'Yes', '0' => 'No'], (empty($metas['acceptable_ar_audit_with_aging_chargeoffs']) ? '' : $metas['acceptable_ar_audit_with_aging_chargeoffs']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
	    
	    <div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('acceptable_payables_audit', 'Is there an acceptable Payables Audit?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('acceptable_payables_audit', ['1' => 'Yes', '0' => 'No'], (empty($metas['acceptable_payables_audit']) ? '' : $metas['acceptable_payables_audit']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('statement_of_pending_legal_issues_provided', 'Has a statement of Pending legal issues been provided?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('statement_of_pending_legal_issues_provided', ['1' => 'Yes', '0' => 'No'], (empty($metas['statement_of_pending_legal_issues_provided']) ? '' : $metas['statement_of_pending_legal_issues_provided']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('liabilities_callable_or_subject_to_baloon_payments', 'Are any of the liabilities callable or subject to balloon payments?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('liabilities_callable_or_subject_to_baloon_payments', ['1' => 'Yes', '0' => 'No'], (empty($metas['liabilities_callable_or_subject_to_baloon_payments']) ? '' : $metas['liabilities_callable_or_subject_to_baloon_payments']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('cash_flow_sufficient_to_pay_off_liabilities', 'If so are reserves and cash flow sufficient to pay off these liabilities if they are unable to be refinanced?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('cash_flow_sufficient_to_pay_off_liabilities', ['1' => 'Yes', '0' => 'No'], (empty($metas['cash_flow_sufficient_to_pay_off_liabilities']) ? '' : $metas['cash_flow_sufficient_to_pay_off_liabilities']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		
		<div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('60_percent_or_fewer_than_5_large_clients_or_short_term_contracts', 'Concentration of income sources. Are 60% or more of the revenues dependent on fewer than five large clients or short term contracts?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('60_percent_or_fewer_than_5_large_clients_or_short_term_contracts', ['1' => 'Yes', '0' => 'No'], (empty($metas['60_percent_or_fewer_than_5_large_clients_or_short_term_contracts']) ? '' : $metas['60_percent_or_fewer_than_5_large_clients_or_short_term_contracts']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('exposed_to_dependancy_or_commodity_price_increase_or_other_potential_volatility', 'Concentration of supply-side risks. Is the company exposed to a dependency on a major supplier or to unpredictable commodity price increases or other potential volatility in expenses?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('exposed_to_dependancy_or_commodity_price_increase_or_other_potential_volatility', ['1' => 'Yes', '0' => 'No'], (empty($metas['exposed_to_dependancy_or_commodity_price_increase_or_other_potential_volatility']) ? '' : $metas['exposed_to_dependancy_or_commodity_price_increase_or_other_potential_volatility']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		
		<div class="row">
			<div class="col-lg-12">
					{!! Form::label('yr_1_salaries', 'Y1 Salaries') !!} 
	    	</div>
			<div class="col-lg-3">
	      		<div class="form-group">
		      		{!! Form::text('yr_1_salaries', (isset($metas['yr_1_salaries']) ? $metas['yr_1_salaries'] : ''), array('class' => 'input-sm form-control'))  !!}
				</div>
			</div>
		</div>
	    
	    
	    
	    <div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('host_compliance_term_conditions_current_credit_facilities', 'Is Host in compliance w terms & conditions of current credit facilities?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::select('host_compliance_term_conditions_current_credit_facilities', ['1' => 'Yes', '0' => 'No'], (empty($metas['host_compliance_term_conditions_current_credit_facilities']) ? '' : $metas['host_compliance_term_conditions_current_credit_facilities']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('company_in_good_standing', 'Is the Company in Good Standing?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('company_in_good_standing', ['1' => 'Yes', '0' => 'No'], (empty($metas['company_in_good_standing']) ? '' : $metas['company_in_good_standing']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('derogatory_findings_public_search_record', 'Was there any Derogatory findings in Public Record search?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('derogatory_findings_public_search_record', ['1' => 'Yes', '0' => 'No'], (empty($metas['derogatory_findings_public_search_record']) ? '' : $metas['derogatory_findings_public_search_record']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		<div class="row">
	    	<div class="col-lg-12">
		    	<div class="form-group">
		  			{!! Form::label('host_business_industry_positive', 'Are future prospects for the Hosts’ Business & Industry positive and without indications for an industry downturn?') !!}
		  			<div class="row">
		  				<div class="col-lg-3">
			  				{!! Form::text('yr_1_salaries', (isset($metas['host_business_industry_positive']) ? $metas['host_business_industry_positive'] : ''), array('class' => 'input-sm form-control'))  !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		<div class="row">
	    	<div class="col-lg-6">
		    	<div class="form-group">
		  			{!! Form::label('derogatory_findings_public_search_record', 'How many years has the current business been operational?') !!}
		  			<div class="row">
		  				<div class="col-lg-6">
			  				{!! Form::select('derogatory_findings_public_search_record', range(0,200), (empty($metas['derogatory_findings_public_search_record']) ? '' : $metas['derogatory_findings_public_search_record']), array('placeholder' => '[Select]', 'class' => 'input-sm form-control')) !!}
		  				</div>				  			
		  			</div>
				</div>
			</div>			      
		</div>
		
		
		<div class="row">
			<div class="col-lg-9">
				Host Facility Savings	
			</div>			    
			<div class="col-lg-1">
				<span class="glyphicon glyphicon-ok" style="color:#5cb85c; " aria-hidden="true"></span>
			</div>			    
			 <div class="col-lg-1">
				<span class="accordion-wsar-score">0</span>/100
			</div>
		</div>
    
		{!! Form::submit('Save & Proceed', array("class" => "btn btn-default")) !!}
		{!! Form::close() !!}
	
			   
       
      </div>
    </div>
  </div>
  
  
  