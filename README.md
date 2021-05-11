Advanced Card-options for kanboard
==================================

Allows advanced control over the appearance _(and options)_ of the task-cards in board-view

### This a BETA-release and not meant for use in production yet!

#### List of features
- Allow to hide the EDIT-button in collapsed view.
- Allow to view the task-description as a mouseover-tooltip in collapsed view.
- Allow to view the latest comment as a mouseover-tooltip in collapsed view.
- Allow to indicate due-today or overdue in collapsed view.
- Allow to display tags and/or category in collapsed view.
- Allow to display task-description and/or latest comment in separate textboxes in expanded view.
  - Allow to dynamically display/hide these textboxes by right-clicking an according icon in the card's header.
  - Select more options for each of the 2 textboxes.
    - Define size of text. _(Small, Medium, Normal)_
    - Define max. number of lines before scrollbars appear.
- Add up to 3 buttons to push the due date of the task.
- Add up to 3 links in the task-dropdown-menu to push the due date.
- Add a button to remove the due date of the task.
- Add up to 3 buttons to set the due date of the task.
  - Option to set minimum task-priority for these buttons to appear.
  - Select more options for the time of day for the newly pushed due date.
    - Round up or down to next/last quarter, half or full hour.
    - Set a fixed time of day. _(e.g. 08:00)_
- Default-preferences for all project-boards can be set via the "Advanced Card options" in the ADMIN-control-panel.
- ONLY project-managers/admins can override these default-preferences via the "Advanced Card options"-panel on a per-project base.
- includes german translation.


Screenshots
-----------

#### Board (expanded) view

![01-Tasks-Expanded](https://user-images.githubusercontent.com/48651533/117608167-ce879900-b15d-11eb-9439-c33088cabbaf.png)

#### Board (collapsed) view
![01-Tasks-Collapsed](https://user-images.githubusercontent.com/48651533/117608144-c2034080-b15d-11eb-9e61-ae6f539911fe.png)





ToDo ...
--------
- [x] Improve LatestComment-tooltip _(collapsed card-view)_ to display as a "Kanboard-tooltip" with rendered Markdown
- [x] Add options to control time _(hh:mm)_ of newly set due date
- [x] Update german translations
- [x] Add screenshots to provide previews of the functionality in README.md

Planned _(new)_ features
--------
- [x] Add ability to toggle visibility of textboxes for description and/or latest-comment in expanded card-view.
- [ ] Add an option to use the "condensed view" of tags + category in expanded card-view.

Credits
-------
Parts of this plugin are based on and inspired by the work of [David Morlitz](https://github.com/dmorlitz), the author of the [kanboard-CardPushDate](https://github.com/dmorlitz/kanboard-CardPushDate)

Because I wanted some more/other options and due to the fact, that we would both override the same templates ... I _(had)_ to make my own plugin ;-)

Author
------

- Manfred Hoffmann
- License MIT

Requirements
------------

- Kanboard >= 1.2.18

Installation
------------

You have the choice between 2 methods:

1. Download the zip file and decompress everything under the directory `plugins/AdvancedCardOptions`
2. Clone this repository into the folder `plugins/AdvancedCardOptions`

Note: Plugin folder is case-sensitive.
