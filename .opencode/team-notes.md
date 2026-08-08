# Team Blackboard

Shared thinking space for the 3-agent team: **build** (orchestrator), **mimo**, **big-pickle**.

Rules:
- Read this file before starting any task.
- Append your updates under the matching section — never rewrite others' entries.
- Keep entries short: one or two lines each.

## Current Goal

Team setup complete — 3-agent team (build, mimo, big-pickle) configured in `opencode.json`. Next goal: TBD by user.

## Ideas

_Team members append ideas here. (Analysis, risks, proposals before implementing.)_

## Decisions

- Agents defined in `opencode.json`: build (primary, deepseek-v4-flash-free), mimo + big-pickle (all mode, coding specialists).
- MCP servers kept: jira, chrome-dev-tools; laravel-boost added (laravel/boost ^2.4 is installed).
- Follow AGENTS.md for MediNote conventions (Laravel 13, thin controllers, services, OpenSpec workflow).

## Progress

- build: created `.opencode/team-notes.md` blackboard; extended `opencode.json` with the 3-agent team and laravel-boost MCP.

## Open Questions

- Confirm model IDs `opencode/mimo-v2.5-free` and `opencode/big-pickle` are available; swap in `opencode.json` if not.
- Restart opencode for the new config to load.
