Feature: Message
  In order to chat with other users
  As a user
  I need to be able to send messages in a channel

  Rules:
  - A user can send a message in a channel only every 24 hours minimum
  - Message has a minimum of 2 characters
  - Message has a maximum of 2048 characters
  - Message can only be send in a channel

  Scenario: Sending a message between 2 and 2048 characters
    Given the user is connected to the channel
    When I add a message "this is a message" in the channel
    Then 1 message should be registered in the channel

  Scenario: Sending a message under 2 characters
    Given the user is connected to the channel
    When I add a message "a" in the channel
    Then 0 message should be registered in the channel
    And it should return the error "message is too short"

  Scenario: Sending a message above 2048 characters
    Given the user is connected to the channel
    When I add a message "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tortor pretium viverra suspendisse potenti nullam ac. Volutpat sed cras ornare arcu. Nisl condimentum id venenatis a condimentum. Ut consequat semper viverra nam libero justo laoreet sit. Id semper risus in hendrerit gravida rutrum. Tempus iaculis urna id volutpat lacus laoreet non curabitur. Dui faucibus in ornare quam viverra orci sagittis eu. Bibendum at varius vel pharetra. Curabitur vitae nunc sed velit dignissim. In hendrerit gravida rutrum quisque. Leo in vitae turpis massa sed elementum tempus egestas. Volutpat est velit egestas dui id ornare. Ac turpis egestas sed tempus urna et pharetra pharetra. Eget mauris pharetra et ultrices. Enim diam vulputate ut pharetra. Id ornare arcu odio ut sem nulla pharetra diam sit. Euismod nisi porta lorem mollis aliquam ut. Amet dictum sit amet justo donec enim diam. Mauris in aliquam sem fringilla ut morbi tincidunt. Arcu non sodales neque sodales ut etiam sit amet. Enim ut sem viverra aliquet. Velit aliquet sagittis id consectetur. Magna eget est lorem ipsum dolor. Neque sodales ut etiam sit amet nisl purus. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Auctor eu augue ut lectus arcu bibendum at. Et netus et malesuada fames ac turpis egestas. Dictumst quisque sagittis purus sit amet volutpat. Nunc faucibus a pellentesque sit. Massa tincidunt dui ut ornare lectus sit amet est. Turpis in eu mi bibendum neque egestas congue quisque. Pellentesque elit eget gravida cum sociis natoque penatibus et magnis. Elementum pulvinar etiam non quam lacus suspendisse faucibus. Ultricies leo integer malesuada nunc vel risus commodo viverra maecenas. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Proin libero nunc consequat interdum varius. Dolor morbi non arcu risus quis. Nec nam aliquam sem et tortor consequat. Rhoncus urna neque viverra justo nec ultrices dui. Hac habitasse platea dictumst quisque sagittis. Habitant morbi tristique senectus et netus et. " in the channel
    Then 0 message should be registered in the channel
    And it should return the error "message is too long"

  Scenario: Sending a message when it's hasn't been 24 hours and another user has answered
    Given the user is connected to the channel
    And he has added a message in the last 24 hours;
    And another user has added a message in the last 24 hours;
    When I add a message "this is a message" in the channel
    Then 3 message should be registered in the channel

  Scenario: Sending a message when it's hasn't been 24 hours and another user hasn't answered
    Given the user is connected to the channel
    And he has added a message in the last 24 hours;
    When I add a message "this is a message" in the channel
    Then 1 message should be registered in the channel
    And it should return the error "you have already sent a message in the last 24 hours"

  Scenario: Sending a message when it's hasn't been 24 hours to another channel
    Given the user is connected to the channel
    And he has added a message in the last 24 hours;
    And he is connected to another channel "other name"
    When I add a message "this is a message" in the new channel
    Then 1 message should be registered in the new channel