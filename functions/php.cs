    public static IEnumerable<TaskGridView> CreateQueryForTask(
          ViewMyTasksRequest request, IWFCaseRepository _rpFS)
        {

            int[] UserId = { request.SecurityUser.Id };
           
            var db = from a in _rpFS.GetNoTrackingDbSet()
                     where a.IsDeleted == false && a.IsActive == true && a.CaseStatus == "OP" && (request.CaseType == null || (a.CaseType == (WorkflowRequestType?)request.CaseType)) &&
                     a.Tokens.Where(wk => wk.IsActive == true && wk.IsDeleted == false && wk.TokenStatus == "FREE").Any(st => st.AssignedUsers.Any(t => UserId.Contains(t.Id)))
                     orderby a.CreatedOn descending
                     select new TaskGridView
                     {
                         Id = a.Id,
                         CaseTitle = a.CaseTitle,
                         Placename = a.Tokens.Where(m => m.TokenStatus == "FREE").FirstOrDefault().Place.Name,
                         CreatedOn = a.WorkItems.Where(c => c.WorkitemStatus == "FI").OrderByDescending(g => g.FinishedDate).Select(j => j.FinishedDate).FirstOrDefault(),
                         CaseType = a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.FinancialStatement ? "Registration of Security Interest" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.FinancialStatementActivity ? "Post Registration Activity" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.UpdateFinancingStatement ? "Update of Security Interest" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.SubordinateFinancingStatement ? "Subordination of Security Interest" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.AssignFinancingStatement ? "Transfer of Security Interest" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.CancelFinancingStatement ? "Discharge of Security Interest" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.MembershipRegistration ? "Registration of Client" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.Membership ? "Postpaid Account Setup" :
                         a.CaseType == Model.WorkflowEngine.Enums.WorkflowRequestType.PaypointUserAssigment ? "PayPoint Users Request" : "N/A",
                         Institution = a.CreatedByUser.Institution.Name,
                         SubmittedBy = a.WorkItems.Where(z => z.WorkitemStatus == "FI").OrderByDescending(m => m.FinishedDate).
                             Select(dd => dd.ExecutingUser.FirstName + " " + dd.ExecutingUser.MiddleName + " " + dd.ExecutingUser.Surname).FirstOrDefault()
                      };

            if (request.CreatedRange != null)
            {
                db = db.Where(s => s.CreatedOn >= request.CreatedRange.StartDate && s.CreatedOn < request.CreatedRange.EndDate);
            }
            return db.ToList();
             

        }