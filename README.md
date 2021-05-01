Advanced Card-options for kanboard
==================================

Allows advanced control over the appearance _(and options)_ of the task-cards in board-view

### This a BETA-release and not meant for use in production yet!

#### List of planned features
- [x] Allow to hide the EDIT-button in collapsed view.
- [x] Allow to view the task-description as a mouseover-tooltip in collapsed view.
- [x] Allow to view the latest comment as a mouseover-tooltip in collapsed view.
  - Needs further improvement, to render as a "Kanboard-tooltip" with rendered Markdown
- [x] Allow to indicate due-today or overdue in collapsed view.
- [x] Allow to display tags and/or category in collapsed view.
  - Needs improvement, so that tags and category can be shown on only 1 "line"
- [x] Allow to view the latest comment in expanded view
  - Needs further improvement(currently displays up to 3 lines)
    - Maybe make longer content scrollable with very thin scrollbars?
- [x] Add up to 3 buttons to push the due-date of the task.
- [x] Add up to 3 links in the task-dropdown-menu to push the due-date
- [x] Add a button to remove the due-date of the task.
- [ ] Add up to 3 buttons to set the due-date of the task.
- [x] Default-preferences for all boards can be set via the "Advanced Card options" in the ADMIN-control-panel
- [x] ONLY project-managers/admins can override these default-preferences via the "Advanced Card options"-panel on a per-project base
- [x] includes german translation
  - Currently incomplete!


Screenshots
-----------

#### Placeholder
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.

![TEMPLATE-KanboardScreenshot](https://user-images.githubusercontent.com/48651533/115109569-dc8b3500-9f76-11eb-98c6-341d3cc56df9.png)



ToDo ...
--------
Implement the planned features ...


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
