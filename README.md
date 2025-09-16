# 🎮 Pokémon Collection Manager

Uma aplicação web para gerenciar sua coleção de Pokémon do Pokémon GO. Desenvolvida com Laravel e integrada à PokéAPI para dados precisos dos Pokémon.

## 📋 Sobre o Projeto

O **Pokémon Collection Manager** é uma ferramenta completa para treinadores de Pokémon GO que desejam organizar e acompanhar sua coleção. A aplicação permite registrar, filtrar e gerenciar todos os seus Pokémon com detalhes específicos do jogo.

### ✨ Funcionalidades

- **Autenticação de Usuários**: Sistema completo de registro e login
- **Gestão de Pokémon**: Adicione, visualize, edite e remova Pokémon da sua coleção
- **Integração com PokéAPI**: Dados automáticos de sprites, tipos, stats e regiões
- **Filtros Avançados**: 
  - Busca por nome
  - Filtro por tipo
  - Filtro por região/geração
  - Pokémon Perfect IV (100%)
  - Pokémon Shiny
  - Pokémon Lucky
  - Pokémon Shadow/Purified
- **Informações Detalhadas**:
  - CP (Combat Power) e HP
  - IVs individuais (Ataque, Defesa, HP)
  - Cálculo automático de porcentagem de IV
  - Level do Pokémon
  - Status especiais (Shiny, Lucky, Shadow, Purified)
  - Sistema de parceiros (Buddy) com níveis
  - Movimentos (rápido e carregado)
  - Data e local de captura
  - Anotações personalizadas

### 🛡️ Segurança

- **Autorização**: Cada usuário só pode acessar sua própria coleção
- **Validação**: Validação rigorosa de todos os dados de entrada
- **Proteção CSRF**: Proteção contra ataques Cross-Site Request Forgery

## 🚀 Tecnologias Utilizadas

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap 5
- **Banco de Dados**: MySQL/SQLite
- **API Externa**: PokéAPI para dados dos Pokémon
- **Autenticação**: Laravel Breeze

## 📦 Instalação

### Pré-requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e NPM
- MySQL ou SQLite

### Passos para Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/pokemon-collection.git
   cd pokemon-collection
   ```

2. **Instale as dependências do PHP**
   ```bash
   composer install
   ```

3. **Instale as dependências do Node.js**
   ```bash
   npm install
   ```

4. **Configure o ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure o banco de dados**
   - Edite o arquivo `.env` com suas credenciais de banco de dados
   - Para SQLite (desenvolvimento), deixe `DB_DATABASE=database/database.sqlite`

6. **Execute as migrações**
   ```bash
   php artisan migrate
   ```

7. **Compile os assets**
   ```bash
   npm run build
   ```

8. **Inicie o servidor de desenvolvimento**
   ```bash
   php artisan serve
   ```

A aplicação estará disponível em `http://localhost:8000`

## 💡 Como Usar

1. **Registro**: Crie uma conta na aplicação
2. **Login**: Faça login com suas credenciais
3. **Adicionar Pokémon**: 
   - Clique em "Adicionar Pokémon"
   - Digite o nome do Pokémon (dados da PokéAPI serão carregados automaticamente)
   - Preencha os dados específicos do seu Pokémon (CP, HP, IVs, etc.)
4. **Filtrar Coleção**: Use os filtros na página principal para encontrar Pokémon específicos
5. **Gerenciar**: Visualize, edite ou remova Pokémon da sua coleção

## 🌟 Demonstração

### Página Principal
- Lista paginada de todos os seus Pokémon
- Filtros em tempo real
- Indicadores visuais para Pokémon especiais

### Detalhes do Pokémon
- Sprite oficial da PokéAPI
- Estatísticas completas
- Histórico de captura
- Anotações personalizadas

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🎯 Roadmap

- [ ] Sistema de estatísticas da coleção
- [ ] Exportação de dados (CSV, JSON)
- [ ] Comparação de Pokémon
- [ ] Sistema de favoritos
- [ ] API REST para aplicações móveis
- [ ] Integração com mais APIs de Pokémon

## 📞 Contato

Se você tiver dúvidas ou sugestões, sinta-se à vontade para abrir uma issue no GitHub.

---

⚡ **Gotta catch 'em all!** ⚡