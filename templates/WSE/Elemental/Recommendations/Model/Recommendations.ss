<% if $Results.Count > 0 %>
    <div class="recommendations-elemental">
        <div class="row collapse">
            <% include SlidersItemList listPos=$pos, useSchema="no", Type=$Top.Type, Size=$Top.Size, Title=$NewTitle, ShowTitle=$Top.ShowTitle, ElementSponsored=$ElementSponsored, ElementDescription=$ElementDescription, ElementLinkTextForTemplate=$ElementLinkTextForTemplate, ElementLinkTargetForTemplate=$ElementLinkTargetForTemplate, ElementTitleLogo=$ElementTitleLogo %>
        </div>
    </div>
<% end_if %>