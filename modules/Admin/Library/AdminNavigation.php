<?php

namespace Modules\Admin\Library;

class AdminNavigation
{
  public static function getAdminNavigation() {
    $links = static::_getAdminNavigation();

    $columns = [];
    foreach($links as $id => $link) {
      if(!$link['pos']) {
        $link['pos'] = 'left';
      }
      $columns[$link['pos']][$id] = $link;
    }

    return $columns;
  }

  protected static function _getAdminNavigation() {
    return [
        "statusselect" => [
            "title" => "Status Select",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Appraisal Dashboard (0)",
                    "url" => "/admin/dashboardstart.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;NJ Branch Status (0)",
                    "url" => false,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 1 Status (0)",
                    "url" => false,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 2 Status (0)",
                    "url" => false,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 3 Status (0)",
                    "url" => false,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 4 Status (0)",
                    "url" => false,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 5 Status (0)",
                    "url" => false,
                    "visible" => true
                ]
            ],
            "pos" => "left",
            "class" => "default"
        ],
        "apprpipeline" => [
            "title" => "Appraisal Pipeline",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Company Pipeline (694)",
                    "url" => "/admin/pipelines.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;NJ Branch Pipeline (28)",
                    "url" => "/admin/pipelines.php?team=164",
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 1 Pipeline (101)",
                    "url" => "/admin/pipelines.php?team=154",
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 2 Pipeline (126)",
                    "url" => "/admin/pipelines.php?team=155",
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 3 Pipeline (231)",
                    "url" => "/admin/pipelines.php?team=156",
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 4 Pipeline (140)",
                    "url" => "/admin/pipelines.php?team=162",
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Team 5 Pipeline (63)",
                    "url" => "/admin/pipelines.php?team=173",
                    "visible" => true
                ],
                [
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Escalated Orders Pipeline (16)",
                    "url" => "/admin/escalatepipeline.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Delayed Orders Pipeline (4)",
                    "url" => "/admin/delayedfiles.php",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "left",
            "class" => "default"
        ],
        "docuvaultpipeline" => [
            "title" => "External DocuVault Pipeline",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Company Pipeline (8,442)",
                    "url" => "/admin/docuvault_pipeline.php",
                    "perms" => true,
                    "visible" => true
                ]
            ],
            "pos" => "left",
            "class" => "default"
        ],
        "alpipeline" => [
            "title" => "Alternative Valuation Pipeline",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Company Pipeline (0)",
                    "url" => "/admin/alpipelines.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "&nbsp;&nbsp;Alt Val - MarkIt Value / TriMerge Pipeline (0)",
                    "url" => "/admin/alpipelines.php?team=165",
                    "visible" => true
                ]
            ],
            "pos" => "left",
            "class" => "default"
        ],
        "postcompletionpipeline" => [
            "title" => "Post Completion Pipelines",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Approve Finished Appraisals (4)",
                    "url" => "/admin/appr_qc_pipeline.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Approve U/W Appraisals (4)",
                    "url" => "/admin/appr_uw_pipeline.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Reconsideration Pipeline (16)",
                    "url" => "/admin/review_pipeline.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Alternative Valuation QC (0)",
                    "url" => "/admin/al_qcpipeline.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Final Appraisals to be Mailed (2)",
                    "url" => "/admin/mailpipeline.php",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "left",
            "class" => "default"
        ],
        "supportpipeline" => [
            "title" => "Support Pipeline",
            "visible" => false,
            "perms" => true,
            "items" => [

            ],
            "pos" => "middle",
            "class" => "default"
        ],
        "ticketmanager" => [
            "title" => "Support Tickets",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Tickets Manager",
                    "url" => "/admin/ticketsmanager.php",
                    "perms" => true
                ],
                [
                    "title" => "Tickets Statistics",
                    "url" => "/admin/ticket_stats.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Ticket Rules",
                    "url" => "/admin/ticket_rules.php",
                    "perms" => true
                ],
                [
                    "title" => "Ticket Statuses",
                    "url" => "/admin/ticket/statuses",
                    "perms" => true
                ],
                [
                    "title" => "Ticket Categories",
                    "url" => "/admin/ticket/categories",
                    "perms" => true
                ],
                [
                    "title" => "Ticket Multi-Moderation",
                    "url" => "/admin/ticket_multi_mod.php",
                    "perms" => true
                ]
            ],
            "pos" => "middle",
            "class" => "default"
        ],
        "accounting" => [
            "title" => "Accounting",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Accounts Payable Report",
                    "url" => "/admin/accounts_payable.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "AL Accounts Payable Report",
                    "url" => "/admin/alaccounts_payable.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Accounts Receivable Report",
                    "url" => "/admin/accounts_receivable.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Accounting General Reports",
                    "url" => "/admin/accounting_general_reports.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Accounting Reports",
                    "url" => "/admin/accountingreports.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "PayView Report Generator",
                    "url" => "/admin/payview.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Lookup Checks Sent/Recv",
                    "url" => "/admin/locatepayments.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Daily Batch",
                    "url" => "/admin/daily_batch.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Batch Payments",
                    "url" => "/admin/batch_check.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "DocuVault Batch Payments",
                    "url" => "/admin/batch_docuvault_check.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Saved Sungard Transactions",
                    "url" => "/admin/payables.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "html" => NULL
                ],
                [
                    "title" => "- Accounts Payable Manager",
                    "url" => "http://admin.landmarkdev.com/accounting/payables?_s=landmark",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "- Accounts Payable Revert",
                    "url" => "/admin/accounting_payable_revert.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "- DocuVault Receivables",
                    "url" => "http://admin.landmarkdev.com/accounting/index?_s=landmark",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "middle",
            "class" => "default"
        ],
        "orderproperties" => [
            "title" => "Customizations",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Appraisal Types",
                    "url" => "/admin/apprtypes.php",
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Access Types",
                    "url" => route('admin.appraisal.access_type.index'),
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Order Statuses",
                    "url" => "/admin/appr_order_statuses.php",
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Loan Reasons",
                    "url" => route('admin.appraisal.loanreason'),
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Loan Types",
                    "url" => route('admin.appraisal.loantype'),
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Occupancy Statuses",
                    "url" => route('admin.appraisal.occupancy.status'),
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Property Types",
                    "url" => route('admin.appraisal.property-types.index'),
                    "perms" => true
                ],
                [
                    "title" => "Appraisal Addendas",
                    "url" => route('admin.appraisal.addendas'),
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "DocuVault Appraisal Types",
                    "url" => route('admin.docuvault.appraisal.index'),
                    "perms" => true
                ],
                [
                    "title" => "Alternative Valuation Order Statuses",
                    "url" => route('admin.valuation.orders.status'),
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Delay Codes Manager",
                    "url" => route('admin.appraisal.delay-codes'),
                    "perms" => true,
                ],
                [
                    "title" => "Sales Tax",
                    "url" => route('admin.management.sale.tax.index'),
                    "perms" => true
                ],
                [
                    "title" => "AMC State Registrations",
                    "url" => route('admin.management.amc-licenses'),
                    "perms" => true
                ]
            ],
            "pos" => "middle",
            "class" => "default"
        ],
        "managerreports" => [
            "title" => "Manager Reports",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Report Generator",
                    "url" => "/admin/manager_report.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "QC Report",
                    "url" => "/admin/qc_report.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Tasks",
                    "url" => "/admin/manager_report.php?action=tasks",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "User Report Generator",
                    "url" => "/admin/user_report.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Reconsideration Report",
                    "url" => "/admin/reconsideration_report.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Client Setting Reports",
                    "url" => "/admin/client_setting_reports.php",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "right",
            "class" => "default"
        ],
        "crm" => [
            "title" => "Landscape CRM",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Leads Manager (10,243)",
                    "url" => "/admin/leads.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Create New Lead",
                    "url" => "/admin/leads.php?action=create-lead",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Lead Reporting",
                    "url" => "/admin/lead_reports.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Sales Stages",
                    "url" => route('admin.crm.sale.stages.index'),
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "right",
            "class" => "default"
        ],
        "statistics" => [
            "title" => "Statistics & User Tracking",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Statistics (0)",
                    "url" => "/admin/statistics.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Big Stats",
                    "url" => "/admin/bigstats.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Accounting Big Stats",
                    "url" => "/admin/accounting_bigstats.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Dashboard Stats",
                    "url" => "/admin/dashboardstats.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Sales Commission Report",
                    "url" => "/admin/sales_report.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "Average Delay Codes",
                    "url" => "/admin/avg_delay_codes.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "Status Select Statistics",
                    "url" => "/admin/status_select_stats.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "System Statistics",
                    "url" => "/admin/system_stats.php",
                    "perms" => true,
                    "visible" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "User Logins",
                    "url" => route('admin.tools.user.logins'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "url" => route('admin.tools.user-logs'),
                    "title" => "User Logs",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "right",
            "class" => "default"
        ],
        "integrations" => [
            "title" => "Integrations",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "API Users",
                    "url" => "/admin/api_users.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Mercury Network",
                    "url" => "/admin/integrations/mercury",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Ditech",
                    "url" => "/admin/ditech.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Google API",
                    "url" => "/admin/googleauth.php",
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "right",
            "class" => "default"
        ],
        "tiger" => [
            "title" => "Tiger",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Clients",
                    "url" => route('admin.tiger.clients.index'),
                    "visible" => true,
                    "perms" => true,
                ],
                [
                    "title" => "AMCs",
                    "url" => route('admin.tiger.amcs.index'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Permissions",
                    "url" => "",
                    "visible" => true,
                    "perms" => true,
                ],
            ],
            "pos" => "right",
            "class" => "warning"
        ],
        "usertracking" => [
            "title" => "User Tracking",
            "visible" => false,
            "perms" => true,
            "items" => [

            ],
            "pos" => "right",
            "class" => "default"
        ],
        "adminuser" => [
            "title" => "Admin User",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "User Manager",
                    "url" => "/admin/user.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Client Settings",
                    "url" => "/admin/group.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Wholesale Lenders",
                    "url" => "/admin/lenders.php",
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "User Groups",
                    "url" => route('admin.management.groups.index'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Admin Groups",
                    "url" => "/admin/admin_group.php",
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Appraiser Groups",
                    "url" => route('admin.management.appraiser.index'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Admin Teams Manager",
                    "url" => "/admin/adminteams.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Appraiser Map",
                    "url" => "/admin/assign.php",
                    "perms" => true
                ],
                [
                    "title" => "Active Users",
                    "url" => "/admin/active_users.php",
                    "visible" => true,
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "FHA Appraiser Licenses",
                    "url" => route('admin.management.fha-licenses.index'),
                    "perms" => true
                ],
                [
                    "title" => "Lenders Exclusionary List",
                    "url" => route('admin.lenders.exclusionary'),
                    "perms" => true
                ],
                [
                    "title" => "ASC Appraiser List",
                    "url" => route('admin.management.asc-licenses'),
                    "perms" => true
                ],
                [
                    "title" => "Google Geo Coding (0)",
                    "url" => "/admin/google_gecode.php",
                    "perms" => true
                ],
                [
                    "title" => "GEO Code Addresses",
                    "url" => route('admin.geo.address'),
                    "perms" => true
                ]
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ],
        "adminlists" => [
            "title" => "Admin Lists",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Zip Code Manager",
                    "url" => route('admin.management.zipcodes'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Email Templates",
                    "url" => route('admin.management.email-templates'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Custom Emails",
                    "url" => route('admin.management.custom-email-templates'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "User Templates",
                    "url" => route('admin.management.user-templates'),
                    "visible" => true,
                    "perms" => true
                ],
                [
                    "title" => "Emails Sent",
                    "url" => route('admin.tools.emails-sent'),
                    "visible" => true,
                    "perms" => true
                ]
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ],
        "controlpanel" => [
            "title" => "Control Panel",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Announcements",
                    "url" => route('admin.management.announcements'),
                    "perms" => true
                ],
                [
                    "title" => "Surveys",
                    "url" => route('admin.management.surveys.index'),
                    "perms" => true
                ],
                [
                    "title" => "Survey Reporting",
                    "url" => route('admin.management.surveys.answers.index'),
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "States Compliance",
                    "url" => "/admin/state_compliance.php",
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "User Order Transfers",
                    "url" => "/admin/user_transfer.php",
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "QC Checklist Editor",
                    "url" => "/admin/appr_qc_checklist.php",
                    "perms" => true
                ],
                [
                    "title" => "QC Data Collection Editor",
                    "url" => "/admin/appr_qc_data_collection.php",
                    "perms" => true
                ],
                [
                    "title" => "UW Checklist Editor",
                    "url" => route('admin.appraisal.under-writing.checklist'),
                    "perms" => true
                ],
                [
                    "title" => "UCDP Business Units",
                    "url" => route('admin.appraisal.ucdp-unit'),
                    "perms" => true
                ],
                [
                    "title" => "EAD Business Units",
                    "url" => route('admin.appraisal.ead-unit'),
                    "perms" => true,
                    "html" => '<div class="hr-line-dashed"></div>'
                ],
                [
                    "title" => "Targus Info",
                    "url" => "/admin/targus.php",
                    "perms" => true,
                    "visible" => true
                ],
                [
                    "title" => "Shipping Labels",
                    "url" => route('admin.tools.shipping-labels'),
                    "perms" => true
                ],
                [
                    "title" => "Keys Legend",
                    "url" => "/admin/key_legend.php",
                    "perms" => true
                ]
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ],
        "autoselectandpricing" => [
            "title" => "AutoSelect & Pricing",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Pricing Versions",
                    "url" => "/admin/appr_state_prices.php",
                    "perms" => true
                ],
                [
                    "title" => "AutoSelect Counties",
                    "url" => "/admin/autoselect-pricing/counties",
                    "perms" => true
                ],
                [
                    "title" => "AutoSelect Appraiser Fees",
                    "url" => route('admin.autoselect.appraiser.fees.index'),
                    "perms" => true
                ],
                [
                    "title" => "AutoSelect Pricing Version Fees",
                    "url" => "/admin/autoselect_pricing_fees.php",
                    "perms" => true
                ],
                [
                    "title" => "AutoSelect Turn Times",
                    "url" => "/admin/autoselect_turntime.php",
                    "perms" => true
                ]
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ],
        "documentsanduploads" => [
            "title" => "Documents & Uploads",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Document Types Manager",
                    "url" => route('admin.document.types'),
                    "perms" => true
                ],
                [
                    "title" => "User Document Types Manager",
                    "url" => route('admin.document.user.types'),
                    "perms" => true
                ],
                [
                    "title" => "Global Documents",
                    "url" => "/admin/order_documents.php",
                    "perms" => true
                ],
                [
                    "title" => "Resource Documents Manager",
                    "url" => route('admin.document.resource'),
                    "perms" => true
                ],
                [
                    "title" => "Upload Manager",
                    "url" => route('admin.document.upload'),
                    "perms" => true
                ]
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ],
        "settingsandtemplates" => [
            "title" => "Settings & Templates",
            "visible" => true,
            "perms" => true,
            "items" => [
                [
                    "title" => "Settings Manager",
                    "url" => route('admin.tools.settings'),
                    "perms" => true
                ],
                [
                    "title" => "Templates Manager",
                    "url" => route('admin.tools.templates'),
                    "perms" => true
                ],
                [
                    "title" => "Home Page Panels Manager",
                    "url" => "/admin/tools/home-page-panels",
                    "perms" => true
                ],
                [
                    "title" => "Custom Pages Manager",
                    "url" => route('admin.tools.custom-pages-manager.index'),
                    "perms" => true
                ],
                [
                    "title" => "Geo Manager",
                    "url" => route('admin.tools.geo.index'),
                    "perms" => true
                ],

                    "title" => "Logo Manager",
                    "url" => route('admin.tools.logos'),
                    "perms" => true
                ],
            ],
            "pos" => "rightouter",
            "class" => "danger"
        ]
    ];
  }
}