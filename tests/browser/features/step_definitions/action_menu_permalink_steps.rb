When(/^I add (\d+) comments to the Topic$/) do |number|
  number.to_i.times do
    on(FlowPage) do |page|
      @saved_random=Random.new.rand.to_s
      step 'I reply with comment "' + 'Selenium comment ' + @saved_random + '"'
    end
  end
end

When(/^I click Permalink from the Actions menu$/) do
  on(FlowPage).permalink_button_element.when_present.click
end

When(/^I click Permalink from the 3rd comment Post Actions menu$/) do
  on(FlowPage).actions_link_permalink_3rd_comment_element.when_present.click
end

When(/^I click the Post Actions link on the 3rd comment on the topic$/) do
  on(FlowPage).third_post_actions_link_element.when_present.click
end

When(/^I go to an old style permalink to my topic$/) do
  on(FlowPage) do |curPage|
    workflowId = curPage.flow_first_topic_element.attribute( 'data-flow-id' )
    visit(FlowOldPermalinkPage, :using_params => {:workflow_id => workflowId})
  end
end

Then(/^I see only one topic on the page$/) do
  # We should have the a post with a heading
  expect(on(FlowPage).flow_first_topic_heading_element.when_present).to be_visible
  # but this should match nothing - there is only one topic.
  expect(on(FlowPage).flow_second_topic_heading_element).not_to be_visible
end

Then(/^the highlighted comment should contain the text for the 3rd comment$/) do
  expect(on(FlowPage).highlighted_post).to match @saved_random
end