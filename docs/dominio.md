# Hello2Ocean (H2O) — Domínio e regras de negócio

Rede social que conecta pessoas por afinidade, usando uma metáfora de oceano e pesca.
Slogan: *"Responda, Combine e Fisgue!"*

O usuário responde perguntas. O sistema compara as respostas com as de outros usuários,
calcula a afinidade entre eles, e as pessoas se "fisgam": entram na rede uma da outra e
passam a conversar.

## Glossário

| Termo | Tabela | Significado |
|---|---|---|
| Fisher | `fishers` | Usuário final: perfil, apelido (`nick`), nome real (`name`), endereço, geolocalização, idioma, país, premium |
| Wave | `waves` | Tema/estilo que agrupa interesses. Hierárquica (`wave_id_main`) e com versões por idioma (`wave_id_language`) |
| Splash | `splashes` | Bloco de perguntas dentro de uma Wave. Pode expirar (`days_to_expire`) |
| Drop | `drops` | A pergunta em si, dentro de um Splash |
| Bottle | `bottles` | Resposta de um Fisher a um Drop (`answer`, `ignore`) |
| Affinity | `affinities` | Afinidade calculada entre dois Fishers (% de afinidade, drops que bateram, drops respondidos) |
| Net | `net` | Rede de amigos (conexões já "pescadas") |
| Chat | `chats` | Mensagens entre Fishers |
| Beach | `beaches` | Agrupamento por idioma (uso ainda indefinido) |

## Áreas do sistema

- **Site público** (`/`): landing page, cadastro, verificação de e-mail.
- **Boat** (`routes/boat.php`): área do Fisher logado (perfil, rede, chat).
- **Hydrosphere** (`routes/hydrosphere.php`, `/hydrosphere`): painel administrativo.

## Regra: privacidade progressiva por afinidade

A afinidade entre dois Fishers define **quais informações de um o outro pode ver**.
Quanto maior a afinidade, mais dados pessoais ficam visíveis.

- Na afinidade baixa, o outro vê só a identidade "fake": apelido (`nick`) e imagem do
  apelido (`nick_image`).
- Conforme a afinidade sobe, vão sendo liberados dados reais, por exemplo foto
  (`profile_image`), nome real (`name`), e-mail e outros dados do perfil.
- Além do desbloqueio automático, o Fisher **é avisado** quando uma informação pode ser
  liberada para alguém e **decide** se libera ou não. Essa liberação vai abrindo novas
  amizades na rede (Net).

Ponto de partida no código: a tabela `net` já tem `profile_image` (padrão
`'profile_image'`) e `display_name` (padrão `'nick'`) por par de amigos, ou seja, já
guarda qual imagem e qual nome um mostra para o outro.

### Configuração das faixas (admin)

As faixas são configuráveis no Hydrosphere em `/hydrosphere/affinity-thresholds`
(tabela `affinity_thresholds`, model `AffinityThreshold`). Cada registro diz qual campo
do Fisher é liberado a partir de qual afinidade mínima, por exemplo foto (`profile_image`)
a partir de 60%. Um campo só pode ter uma faixa.

Os campos que podem ser configurados estão no enum `App\Enums\RevealableField`. Para
liberar um campo novo, adicione-o ao enum, às traduções em `lang/*/enums.php` e ao
`AffinityThresholdSeeder`.

Valores padrão (`php artisan db:seed --class=AffinityThresholdSeeder`), crescentes pela
sensibilidade do dado segundo a LGPD. O seeder não sobrescreve faixas já editadas no admin.

| Afinidade | Campos |
|---|---|
| 0% | país, idioma (considerados públicos, sempre visíveis) |
| 20% | estado (UF) |
| 30% | cidade |
| 40% | gênero |
| 50% | data de nascimento |
| 60% | foto de perfil |
| 70% | nome real |
| 75% | bairro |
| 80% | e-mail |
| 85% | CEP, código postal |
| 95% | endereço, número, complemento, endereço internacional |
| 100% | latitude, longitude (localização exata) |

Ficam fora, por nunca serem exibidos a outro Fisher ou por já serem públicos: `nick`,
`nick_image`, senha, `secret_code`, tokens, contadores de login, `premium_until` e datas
de controle.

### A definir

- Se a liberação é mútua ou vale só em uma direção.
- Se o Fisher pode revogar uma liberação já feita.
- Como o aviso chega (notificação no Boat, e-mail, broadcast em tempo real).

## Estado atual (2026-09-25)

- O modelo de dados está pronto, mas o fluxo de responder perguntas não existe ainda
  (`app/Livewire/Boat/Bottle.php` renderiza uma view vazia).
- Não há código que calcule a afinidade, só as tabelas e as views SQL
  `view_affinities` e `view_net`.
- As faixas já são configuráveis no admin, mas ainda não são aplicadas no Boat: o
  perfil de um Fisher ainda não esconde campos com base na afinidade.
